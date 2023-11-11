<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// kelas untuk melakukan migrasi ke database untuk membuat tabel customers_vehicles atau tabel pesanan
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // membuat kolom-kolom tabel serta menentukan foreign key
        Schema::create('customers_vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade'); // foreign key
            $table->foreignId('vehicle_id')->constrained('vehicles')->onUpdate('cascade')->onDelete('cascade'); // foreign key

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_vehicles');
    }
};
