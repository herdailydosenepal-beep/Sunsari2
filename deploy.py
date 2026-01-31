#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Sunsari-2 Website FTP Deployment Script
Automatically uploads website files to hosting server
"""

import os
import sys
from ftplib import FTP, error_perm
from pathlib import Path
from datetime import datetime
import hashlib
from dotenv import load_dotenv

# Set UTF-8 encoding for Windows console
if sys.platform == "win32":
    import codecs

    sys.stdout = codecs.getwriter("utf-8")(sys.stdout.buffer, "strict")
    sys.stderr = codecs.getwriter("utf-8")(sys.stderr.buffer, "strict")


# Color codes for terminal output
class Colors:
    GREEN = "\033[92m"
    YELLOW = "\033[93m"
    RED = "\033[91m"
    BLUE = "\033[94m"
    BOLD = "\033[1m"
    END = "\033[0m"


def print_success(msg):
    print(f"{Colors.GREEN}[OK] {msg}{Colors.END}")


def print_error(msg):
    print(f"{Colors.RED}[ERROR] {msg}{Colors.END}")


def print_info(msg):
    print(f"{Colors.BLUE}[INFO] {msg}{Colors.END}")


def print_warning(msg):
    print(f"{Colors.YELLOW}[WARN] {msg}{Colors.END}")


class FTPDeployer:
    def __init__(self):
        # Load environment variables
        load_dotenv()

        self.ftp_host = os.getenv("FTP_HOST", "145.79.211.42")
        self.ftp_user = os.getenv("FTP_USER", "u852370365.sunsari2.com")
        self.ftp_pass = os.getenv("FTP_PASS")
        self.ftp_port = int(os.getenv("FTP_PORT", "21"))
        self.remote_dir = os.getenv(
            "FTP_REMOTE_DIR", "/home/u852370365/domains/sunsari2.com/public_html"
        )
        self.local_dir = Path(__file__).parent

        self.ftp = None
        self.uploaded_files = 0
        self.skipped_files = 0
        self.failed_files = 0

        # Files and folders to exclude
        self.exclude_patterns = [
            ".git",
            ".agents",
            ".gemini",
            ".env",
            ".env.local",
            "deploy.py",
            "deploy.bat",
            "explore_ftp.py",
            "test_deploy.py",
            "requirements.txt",
            "deploy_config.json",
            "__pycache__",
            ".ruff_cache",
            "*.pyc",
            ".gitignore",
            "*.md",  # Exclude all markdown files
            "*.log",
            "server.log",
            ".htaccess.example",
            "node_modules",
            ".vscode",
            ".idea",
            ".qoder",
            "*.tmp",
            "*.bak",
        ]

    def connect(self):
        """Connect to FTP server"""
        try:
            if not self.ftp_pass:
                print_error("FTP password not configured!")
                return False

            print_info(f"Connecting to {self.ftp_host}:{self.ftp_port}...")
            self.ftp = FTP()
            self.ftp.connect(self.ftp_host, self.ftp_port, timeout=30)
            self.ftp.login(self.ftp_user, self.ftp_pass)
            print_success(f"Connected as {self.ftp_user}")
            print_info(f"Server: {self.ftp.getwelcome()}")
            return True
        except Exception as e:
            print_error(f"Connection failed: {str(e)}")
            return False

    def should_exclude(self, path):
        """Check if file/folder should be excluded"""
        path_str = str(path)
        for pattern in self.exclude_patterns:
            if pattern.startswith("*"):
                # Wildcard pattern (e.g., *.pyc)
                if path_str.endswith(pattern[1:]):
                    return True
            else:
                # Exact match or folder name
                if pattern in path_str.split(os.sep):
                    return True
        return False

    def create_remote_directory(self, remote_path):
        """Create directory on remote server if it doesn't exist"""
        if not self.ftp:
            return
        try:
            self.ftp.cwd(remote_path)
        except error_perm:
            try:
                # Directory doesn't exist, create it
                parts = remote_path.strip("/").split("/")
                current = "/"
                for part in parts:
                    if not part:
                        continue
                    current = f"{current}{part}/"
                    try:
                        self.ftp.cwd(current)
                    except error_perm:
                        self.ftp.mkd(current)
                        print_success(f"Created directory: {current}")
            except Exception as e:
                print_warning(f"Could not create directory {remote_path}: {str(e)}")

    def upload_file(self, local_path, remote_path):
        """Upload a single file"""
        if not self.ftp:
            return False
        try:
            with open(local_path, "rb") as f:
                self.ftp.storbinary(f"STOR {remote_path}", f)
            return True
        except Exception as e:
            print_error(f"Failed to upload {local_path}: {str(e)}")
            return False

    def deploy(self, force=False):
        """Deploy all files to server"""
        if not self.ftp_pass:
            print_error("FTP password not found in .env file!")
            print_info("Please create a .env file with your FTP credentials")
            return False

        if not self.connect():
            return False

        print_info(f"Starting deployment from {self.local_dir}")
        print_info(f"Remote directory: {self.remote_dir}")
        print("")

        # Change to remote directory
        if not self.ftp:
            return False
        try:
            self.ftp.cwd(self.remote_dir)
        except error_perm:
            print_error(f"Remote directory {self.remote_dir} does not exist!")
            return False

        # Walk through local directory
        for root, dirs, files in os.walk(self.local_dir):
            # Remove excluded directories from the walk
            dirs[:] = [d for d in dirs if not self.should_exclude(Path(root) / d)]

            # Get relative path
            rel_root = Path(root).relative_to(self.local_dir)

            # Skip if root itself is excluded
            if self.should_exclude(rel_root):
                continue

            # Create remote directory structure
            if str(rel_root) != ".":
                remote_subdir = (
                    f"{self.remote_dir}/{str(rel_root).replace(os.sep, '/')}"
                )
                self.create_remote_directory(remote_subdir)

            # Upload files
            for file in files:
                local_file = Path(root) / file

                # Skip excluded files
                if self.should_exclude(local_file):
                    self.skipped_files += 1
                    continue

                # Construct remote path
                if str(rel_root) != ".":
                    remote_file = (
                        f"{self.remote_dir}/{str(rel_root).replace(os.sep, '/')}/{file}"
                    )
                else:
                    remote_file = f"{self.remote_dir}/{file}"

                # Upload file
                file_size = local_file.stat().st_size
                print_info(f"Uploading: {rel_root / file} ({file_size:,} bytes)")

                if self.upload_file(local_file, remote_file):
                    self.uploaded_files += 1
                    print_success(f"Uploaded: {file}")
                else:
                    self.failed_files += 1

        # Disconnect
        self.ftp.quit()

        # Print summary
        print("")
        print(f"{Colors.BOLD}{'=' * 60}{Colors.END}")
        print(f"{Colors.BOLD}Deployment Summary{Colors.END}")
        print(f"{Colors.BOLD}{'=' * 60}{Colors.END}")
        print_success(f"Uploaded: {self.uploaded_files} files")
        print_warning(f"Skipped: {self.skipped_files} files")
        if self.failed_files > 0:
            print_error(f"Failed: {self.failed_files} files")
        print("")

        if self.failed_files == 0:
            print_success("Deployment completed successfully!")
            print_info(f"Your website is now live at: https://sunsari2.com")
        else:
            print_warning("Deployment completed with some errors")

        return self.failed_files == 0

    def test_connection(self):
        """Test FTP connection"""
        print_info("Testing FTP connection...")
        if self.connect() and self.ftp:
            try:
                self.ftp.cwd(self.remote_dir)
                print_success(
                    f"Successfully accessed remote directory: {self.remote_dir}"
                )

                # List files
                print_info("Files in remote directory:")
                files = self.ftp.nlst()
                for f in files[:10]:  # Show first 10 files
                    print(f"  - {f}")
                if len(files) > 10:
                    print(f"  ... and {len(files) - 10} more files")

                self.ftp.quit()
                print_success("Connection test successful!")
                return True
            except Exception as e:
                print_error(f"Error accessing remote directory: {str(e)}")
                return False
        return False


def main():
    """Main entry point"""
    print(f"{Colors.BOLD}")
    print("=" * 60)
    print("  Sunsari-2 Website Deployment Tool")
    print("=" * 60)
    print(f"{Colors.END}\n")

    deployer = FTPDeployer()

    # Check command line arguments
    if len(sys.argv) > 1:
        command = sys.argv[1].lower()

        if command == "test":
            # Test connection
            deployer.test_connection()
        elif command == "deploy":
            # Deploy files
            force = "--force" in sys.argv
            deployer.deploy(force=force)
        elif command == "help":
            print("Usage:")
            print("  python deploy.py test          - Test FTP connection")
            print("  python deploy.py deploy        - Deploy website to hosting")
            print("  python deploy.py deploy --force - Force deploy all files")
            print("  python deploy.py help          - Show this help message")
        else:
            print_error(f"Unknown command: {command}")
            print("Run 'python deploy.py help' for usage information")
    else:
        # Default: show menu
        print("Select an option:")
        print("  1. Test FTP connection")
        print("  2. Deploy website")
        print("  3. Exit")
        print()

        choice = input("Enter your choice (1-3): ").strip()

        if choice == "1":
            deployer.test_connection()
        elif choice == "2":
            deployer.deploy()
        elif choice == "3":
            print("Goodbye!")
        else:
            print_error("Invalid choice")


if __name__ == "__main__":
    main()
