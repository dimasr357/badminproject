@echo off
echo ========================================
echo Setting up Admin Account
echo ========================================
echo.

echo Running migrations...
php artisan migrate
echo.

echo Creating admin account...
php artisan db:seed --class=AdminSeeder
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Admin Login Credentials:
echo Email: admin@gmail.com
echo Password: admin123
echo.
echo Access admin panel at: http://127.0.0.1:8000/admin/login
echo.
pause
