<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

echo "Testing Admin Login System\n";
echo "==========================\n\n";

// Test 1: Check if admin exists
$admin = Admin::where('email', 'admin@gmail.com')->first();

if (!$admin) {
    echo "❌ Admin not found!\n";
    exit(1);
}

echo "✓ Admin found:\n";
echo "  Email: {$admin->email}\n";
echo "  Username: {$admin->username}\n\n";

// Test 2: Check password
$passwordTest = Hash::check('admin123', $admin->password);
echo "Password Test: " . ($passwordTest ? "✓ PASS" : "❌ FAIL") . "\n\n";

// Test 3: Check routes
echo "Routes to test:\n";
echo "  Login Page: http://127.0.0.1:8000/admin/login\n";
echo "  Dashboard: http://127.0.0.1:8000/admin/dashboard\n\n";

echo "Login Credentials:\n";
echo "  Email: admin@gmail.com\n";
echo "  Password: admin123\n\n";

if ($passwordTest) {
    echo "✓ Everything looks good! Try logging in at:\n";
    echo "  http://127.0.0.1:8000/admin/login\n";
} else {
    echo "❌ Password verification failed. Run seeder again:\n";
    echo "  php artisan db:seed --class=AdminSeeder --force\n";
}
