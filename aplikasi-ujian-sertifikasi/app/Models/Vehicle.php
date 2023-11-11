<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// merupakan kelas model untuk menyimpan data-data kendaraan
class Vehicle extends Model
{
    use HasFactory;

    // nama tabel penyimpanan di database
    protected $table = 'vehicles';

    // daftar nama kolom tabel yang bisa diedit
    protected $fillable = [
        'model',
        'tahun',
        'jumlah_penumpang',
        'manufaktur',
        'harga',
        'gambar'
    ];

    // function yang melambangkan relasi many to many dengan kelas Customer
    function customers()
    {
        return $this->belongsToMany(Customer::class, "customers_vehicles")->withTimestamps()->orderByPivot("updated_at")->withPivot('id', 'vehicle_id', 'customer_id');
    }

    // function yang melambangkan relasi one on one dengan kelas Car
    function car()
    {
        return $this->hasOne(Car::class, 'vehicle_id', 'id');
    }

    // function yang melambangkan relasi one on one dengan kelas Motor
    function motor()
    {
        return $this->hasOne(Motor::class, 'vehicle_id', 'id');
    }

    // function yang melambangkan relasi one on one dengan kelas Truck
    function truck()
    {
        return $this->hasOne(Truck::class, 'vehicle_id', 'id');
    }
}
