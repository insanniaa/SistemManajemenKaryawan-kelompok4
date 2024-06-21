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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email');
            $table->string('jabatan')->default('Karyawan');
            $table->string('tempat_lahir')->default('');
            $table->date('tanggal_lahir');
            $table->string('alamat')->default('');
            $table->date('tanggal_bergabung');
            $table->string('nomor_handphone', 20)->default('0');
            $table->string('nomor_rekening',255)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
