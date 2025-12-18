@echo off
echo ========================================
echo    FRESH MIGRATION & SEED SCRIPT
echo ========================================
echo.

echo 🗑️  Dropping all tables...
php artisan db:wipe --force

echo.
echo 🔄 Running fresh migrations...
php artisan migrate:fresh --force

echo.
echo 🌱 Seeding database...
php artisan db:seed --force

echo.
echo ✅ Fresh migration and seeding completed!
echo.
echo 🔐 Login credentials:
echo    Admin: admin@manaahel.com / password
echo    User: ahmad@example.com / password
echo.
pause