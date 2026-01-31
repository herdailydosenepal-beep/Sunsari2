#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Quick script to view FTP server files"""

from ftplib import FTP
from dotenv import load_dotenv
import os
import sys

# Set UTF-8 encoding for Windows console
if sys.platform == "win32":
    import codecs

    sys.stdout = codecs.getwriter("utf-8")(sys.stdout.buffer, "strict")
    sys.stderr = codecs.getwriter("utf-8")(sys.stderr.buffer, "strict")

load_dotenv()

print("\nConnecting to FTP server...")
try:
    ftp = FTP()
    ftp.connect("145.79.211.42", 21, timeout=30)
    ftp.login("u852370365.sunsari2.com", os.getenv("FTP_PASS"))

    print(f"\n{'=' * 60}")
    print("Current Directory:", ftp.pwd())
    print(f"{'=' * 60}\n")

    print("Files and Folders on Server:\n")
    items = ftp.nlst()

    # Separate files and directories
    files = []
    dirs = []

    for item in items:
        if item in [".", ".."]:
            continue
        try:
            # Try to change to it - if it works, it's a directory
            current = ftp.pwd()
            ftp.cwd(item)
            ftp.cwd(current)
            dirs.append(item)
        except:
            files.append(item)

    if dirs:
        print("Directories:")
        for d in sorted(dirs):
            print(f"  [DIR]  {d}")

    print()

    if files:
        print("Files:")
        for f in sorted(files):
            print(f"  [FILE] {f}")

    print(f"\n{'=' * 60}")
    print(f"Total: {len(dirs)} directories, {len(files)} files")
    print(f"{'=' * 60}\n")

    ftp.quit()
    print("Connection closed successfully.\n")

except Exception as e:
    print(f"\nError: {e}\n")
    sys.exit(1)
