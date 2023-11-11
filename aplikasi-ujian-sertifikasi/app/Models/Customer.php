<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// merupakan kelas model untuk menyimpan data-data customer
class Customer extends Model
{
    use HasFactory;

    // nama tabel penyimpanan di database
    protected $table = 'customers';

    // nama-nama kolom tabel yang bisa diedit
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'id_card'
    ];

    // melambangkan relasi many to many dengan kelas model Vehicle
    function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, "customers_vehicles")->withTimestamps()->orderByPivot("updated_at")->withPivot('id', 'vehicle_id', 'customer_id');
    }
}
