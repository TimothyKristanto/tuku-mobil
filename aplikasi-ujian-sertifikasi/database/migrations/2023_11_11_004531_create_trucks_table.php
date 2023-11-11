<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// kelas untuk melakukan migrasi ke database untuk membuat tabel trucks
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // membuat kolom-kolom tabel serta menentukan foreign key
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();

            $table->string('jumlah_ban');
            $table->string('luas_kargo');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onUpdate('cascade')->onDelete('cascade'); // foreign key

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trucks');
    }
};
