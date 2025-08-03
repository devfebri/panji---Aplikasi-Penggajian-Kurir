<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== User Data dengan NoHP ===\n";
$users = User::all(['id', 'nama', 'email', 'nohp']);
foreach($users as $user) {
    echo "ID: {$user->id}, Nama: {$user->nama}, Email: {$user->email}, NoHP: " . ($user->nohp ?: 'NULL/EMPTY') . "\n";
}
