<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// merupakan kelas model untuk menyimpan data-data jenis kendaraan motor
class Motor extends Model
{
    use HasFactory;

    // nama tabel penyimpanan di database
    protected $table = 'motors';

    // daftar nama kolom tabel yang bisa diedit
    protected $fillable = [
        'ukuran_bagasi',
        'kapasitas_bensin'
    ];

    // function yang melambangkan relasi one on one dengan kelas Vehicle
    function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
