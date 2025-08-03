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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->string('email_karyawan');
            $table->string('nik_karyawan');
            $table->string('keterangan');
            $table->string('alasan_ditolak')->nullable();
            $table->date('tgl_cuti');
            $table->boolean('cuti_status')->default(0);
            $table->rememberToken();
            $table->timestamps();
            // $table->unsignedBigInteger('jabatan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
