<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nik',20);
            $table->string('nohp', 15)->nullable();
            $table->string('jenis_kelamin',12);
            $table->boolean('status');
            $table->rememberToken();
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
            // $table->unsignedBigInteger('jabatan_id')->nullable();
            // $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
