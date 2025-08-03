<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update any users that have null nohp with a temporary unique value
        $usersWithoutNohp = DB::table('users')->whereNull('nohp')->get();
        foreach ($usersWithoutNohp as $user) {
            DB::table('users')->where('id', $user->id)->update([
                'nohp' => 'temp_' . $user->id . '_' . time()
            ]);
        }
        
        Schema::table('users', function (Blueprint $table) {
            // Make nohp not nullable and unique
            $table->string('nohp', 15)->nullable(false)->change();
            $table->unique('nohp');
            
            // Make email nullable since we're using nohp for login
            $table->dropUnique(['email']);
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert changes
            $table->string('nohp', 15)->nullable()->change();
            $table->dropUnique(['nohp']);
            $table->string('email')->nullable(false)->unique()->change();
        });
    }
};
