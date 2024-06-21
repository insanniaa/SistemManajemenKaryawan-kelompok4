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
        Schema::create('gaji', function (Blueprint $table) {
           $table->integer('id_gaji');
           $table->unique('id_gaji');
           $table->string('nama_karyawan');
           $table->string('jabatan');
           $table->string('bulan');
           $table->integer('gaji_pokok');
           $table->integer('potongan');
           $table->integer('total_gaji');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
