<?php
try {
    require 'vendor/autoload.php';
    $app = require 'bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    echo "Database connection test..." . PHP_EOL;
    
    $users = App\Models\User::all();
    echo "Users found: " . $users->count() . PHP_EOL;
    
    foreach($users as $user) {
        $nohp = $user->nohp ?: 'NULL';
        echo "User: {$user->nama}, NoHP: {$nohp}, Email: {$user->email}" . PHP_EOL;
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
?>
