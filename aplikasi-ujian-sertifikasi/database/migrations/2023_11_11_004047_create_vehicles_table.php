<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// kelas untuk melakukan migrasi ke database untuk membuat tabel kendaraan
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // membuat kolom-kolom tabel
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('model');
            $table->string('tahun');
            $table->string('jumlah_penumpang');
            $table->string('manufaktur');
            $table->unsignedBigInteger('harga');
            $table->string('gambar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
