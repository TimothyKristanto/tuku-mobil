<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// merupakan kelas model untuk menyimpan data-data jenis kendaraan truck
class Truck extends Model
{
    use HasFactory;

    // nama tabel penyimpanan di database
    protected $table = 'trucks';

    // daftar nama kolom tabel yang bisa diedit
    protected $fillable = [
        'jumlah_ban',
        'luas_kargo'
    ];

    // function yang melambangkan relasi one on one dengan kelas Vehicle
    function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
