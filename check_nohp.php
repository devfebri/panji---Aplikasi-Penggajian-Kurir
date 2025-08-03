<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Checking Users NoHP Status ===" . PHP_EOL;

$users = App\Models\User::all(['id', 'nama', 'email', 'nohp']);
echo "Total users: " . $users->count() . PHP_EOL;

$usersWithoutNohp = $users->filter(function($user) {
    return empty($user->nohp);
});

echo "Users without nohp: " . $usersWithoutNohp->count() . PHP_EOL;

foreach($users as $user) {
    echo "ID: {$user->id}, Nama: {$user->nama}, Email: {$user->email}, NoHP: " . ($user->nohp ?: 'NULL/EMPTY') . PHP_EOL;
}

// Check for duplicate nohp
$nohpCount = App\Models\User::whereNotNull('nohp')->groupBy('nohp')->havingRaw('count(*) > 1')->get(['nohp']);
if ($nohpCount->count() > 0) {
    echo PHP_EOL . "Duplicate NoHP found:" . PHP_EOL;
    foreach($nohpCount as $item) {
        echo "NoHP: {$item->nohp}" . PHP_EOL;
    }
} else {
    echo PHP_EOL . "No duplicate NoHP found." . PHP_EOL;
}
?>
