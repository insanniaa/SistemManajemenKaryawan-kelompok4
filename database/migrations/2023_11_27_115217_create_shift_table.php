<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            // $table->string('nama');
            // $table->string('jabatan');
            $table->foreignId('karyawan_id')->constrained();
            $table->string('hari');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
