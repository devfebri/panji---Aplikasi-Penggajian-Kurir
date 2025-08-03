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
        Schema::create('gaji_kurir', function (Blueprint $table) {
            $table->id();
            $table->integer('kurir_id');
            $table->date('tanggal_kerja');
            $table->string('pikup',50);
            $table->string('pud',50);
            $table->string('total',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_kurir');
    }
};
