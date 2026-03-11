<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Admin;

echo "Checking Admin accounts...\n\n";

$admins = Admin::all();

if ($admins->count() > 0) {
    echo "Found " . $admins->count() . " admin(s):\n";
    foreach ($admins as $admin) {
        echo "- ID: {$admin->id}\n";
        echo "  Username: {$admin->username}\n";
        echo "  Email: {$admin->email}\n";
        echo "  Name: {$admin->nama_lengkap}\n";
        echo "  Phone: {$admin->no_hp}\n\n";
    }
    
    // Test password
    $testAdmin = Admin::where('email', 'admin@gmail.com')->first();
    if ($testAdmin) {
        $passwordCheck = \Hash::check('admin123', $testAdmin->password);
        echo "Password 'admin123' check: " . ($passwordCheck ? "✓ VALID" : "✗ INVALID") . "\n";
    }
} else {
    echo "No admin accounts found!\n";
    echo "Run: php artisan db:seed --class=AdminSeeder\n";
}
