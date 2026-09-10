@echo off
title VoltMetrics Energy Calculators Server
echo =======================================================
echo Starting VoltMetrics Home Energy Calculators Server
echo URL: http://localhost:8080/
echo All Calculators: http://localhost:8080/all-calculators.php
echo =======================================================
if exist "C:\xampp\php\php.exe" (
    "C:\xampp\php\php.exe" -S localhost:8080
) else (
    php -S localhost:8080
)
pause
