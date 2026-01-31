@echo off
REM Quick Deployment Script for Windows
REM This is a convenience wrapper for deploy.py

echo ========================================
echo   Sunsari-2 Website Deployment
echo ========================================
echo.

:menu
echo Select an option:
echo   1. Test FTP Connection
echo   2. Preview Deployment (Dry Run)
echo   3. Deploy Website to Hosting
echo   4. View Current Files on Server
echo   5. Exit
echo.

set /p choice="Enter your choice (1-5): "

if "%choice%"=="1" (
    echo.
    python deploy.py test
    echo.
    pause
    goto menu
)

if "%choice%"=="2" (
    echo.
    python test_deploy.py
    echo.
    pause
    goto menu
)

if "%choice%"=="3" (
    echo.
    echo WARNING: This will upload all files to https://sunsari2.com
    set /p confirm="Are you sure? Type YES to confirm: "
    if /i "%confirm%"=="YES" (
        echo.
        echo Starting deployment...
        python deploy.py deploy
    ) else (
        echo.
        echo Deployment cancelled. You must type YES to deploy.
    )
    echo.
    pause
    goto menu
)

if "%choice%"=="4" (
    echo.
    python explore_ftp.py
    echo.
    pause
    goto menu
)

if "%choice%"=="5" (
    echo Goodbye!
    exit /b 0
)

echo Invalid choice. Please try again.
echo.
goto menu
