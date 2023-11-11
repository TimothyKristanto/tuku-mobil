<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// kelas untuk melakukan migrasi ke database untuk  membuat tabel customers
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // membuat kolom-kolom tabel
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('id_card');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
