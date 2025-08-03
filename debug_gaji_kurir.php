<?php
// Simple debug script to check GajiKurir data
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\GajiKurir;

echo "=== DEBUG GAJI KURIR DATA ===\n\n";

echo "Users in database:\n";
$users = User::all(['id', 'nama', 'email']);
foreach ($users as $user) {
    echo "ID: {$user->id}, Nama: {$user->nama}, Email: {$user->email}\n";
}

echo "\nGajiKurir data:\n";
$gajiKurirs = GajiKurir::with('kurir')->get();
foreach ($gajiKurirs as $gk) {
    echo "ID: {$gk->id}, Kurir: {$gk->kurir->nama}, Tanggal: {$gk->tanggal_kerja}, Pickup: {$gk->pikup}, PUD: {$gk->pud}, Total: {$gk->total}\n";
}

echo "\n=== END DEBUG ===\n";
