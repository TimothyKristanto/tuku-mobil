<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Truck;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    // berfungsi untuk menampilkan view vehicle.blade.php
    function index()
    {
        // mengambil seluruh data kendaraan
        $vehicles = Vehicle::all();

        // berfungsi sebagai tempat penyimpanan jenis-jenis kendaraan
        $types = [];

        // proses looping untuk menentukan jenis kendaraan dan menambahkan ke dalam array $types
        foreach ($vehicles as $vehicle) {
            if ($vehicle->car()->exists()) { // melakukan pengecekan apakah data kendaraan ini memiliki jenis kendaraan mobil
                array_push($types, 'Mobil'); // apabila iya, maka ditambahkan jenis mobil ke dalam array $types
            } else if ($vehicle->motor()->exists()) { // melakukan pengecekan apakah data kendaraan ini memiliki jenis kendaraan motor
                array_push($types, 'Motor'); // apabila iya, maka ditambahkan jenis motor ke dalam array $types
            } else if ($vehicle->truck()->exists()) { // melakukan pengecekan apakah data kendaraan ini memiliki jenis kendaraan truck
                array_push($types, 'Truck'); // apabila iya, maka ditambahkan jenis truck ke dalam array $types
            }
        }

        // menampilkan view vehicle.blade.php untuk menampilkan data singkat seluruh kendaraan
        return view('vehicles.vehicle', [
            // melakukan passing data yang diperlukan untuk ditampilkan dalam view
            'vehicles' => $vehicles,
            'types' => $types
        ]);
    }

    // berfungsi untuk menampilkan halaman addVehicle.blade.php
    function addVehicleView()
    {
        // menampilkan halaman view addVehicle.blade.php untuk menampilkan form tambah kendaraan
        return view('vehicles.addVehicle', []);
    }

    /* berfungsi untuk menambahkan data kendaraan ke database. Parameter $request menampung data kendaraan. */

    function addVehicle(Request $request)
    {
        // berfungsi sebagai validator format data
        $request->validate([
            'model' => 'required',
            'tahun' => 'required',
            'jumlah_penumpang' => 'required|numeric',
            'manufaktur' => 'required',
            'harga' => 'required|numeric',
            'jenis' => 'required',
            'data1' => 'required|numeric',
            'data2' => 'required|numeric',
            'image' => 'required|image|file|max:2048'
        ]);

        // berfungsi untuk menambahkan data kendaraan ke dalam database
        $vehicleData = Vehicle::create([
            'model' => $request->model,
            'tahun' => $request->tahun,
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'manufaktur' => $request->manufaktur,
            'harga' => $request->harga,
            'gambar' => $request->file("image")->store("images")
        ]);

        // dd($request->jenis);
        // dd($request->data1);
        // dd($request->data2);

        // proses pengecekan kondisional yang berfungsi untuk menambahkan data-data jenis kendaraan ke database
        if ($request->jenis == 'mobil') { // mengecek apabila jenis kendaraannya dari variabel $request adalah mobil
            $vehicleData->car()->create([ // apabila iya, maka tambahkan data-data yang berhubungan dengan jenis kendaraan mobil ke database
                'tipe_bbm' => $request->data1,
                'luas_bagasi' => $request->data2
            ]);
        } else if ($request->jenis == 'motor') { // mengecek apabila jenis kendaraannya dari variabel $request adalah motor
            $vehicleData->motor()->create([ // apabila iya, maka tambahkan data-data yang berhubungan dengan jenis kendaraan motor ke database
                'ukuran_bagasi' => $request->data1,
                'kapasitas_bensin' => $request->data2
            ]);
        } else if ($request->jenis == 'truck') { // mengecek apabila jenis kendaraannya dari variabel $request adalah truck
            $vehicleData->truck()->create([ // apabila iya, maka tambahkan data-data yang berhubungan dengan jenis kendaraan truck ke database
                'jumlah_ban' => $request->data1,
                'luas_kargo' => $request->data2
            ]);
        }

        // melakkukan routing ke /vehicle
        return redirect('/vehicle');
    }

    /* merupakan function untuk menghapus data kendaraan berdasarkan parameter $vehicleId, yang menyimpan 
     data id kendaraan */
    function deleteVehicle($vehicleId)
    {
        Vehicle::destroy($vehicleId); // menghapus data kendaraan tertentu berdasarkan id kendaraan

        return redirect('/vehicle'); // melakukan routing ke /vehicle
    }

    /* function berfungsi untuk menampilkan halaman view updateVehicle.blade.php. Parameter $vehicleId
    menyimpan data id kendaraan. */
    function updateVehicleView($vehicleId)
    {
        // mengambil data kendaraan tertentu berdasarkan parameter $vehicleId
        $vehicleData = Vehicle::where('id', $vehicleId)->first();

        // variabel $type berguna untuk menyimpan jenis kendaraan
        $type = '';

        // proses penentuan jenis kendaraan
        if ($vehicleData->car()->exists()) { // mengecek apabila jenis kendaraannya mobil
            $type = 'mobil'; // apabila benar mobil, maka nilai $type dijadikan mobil
        } else if ($vehicleData->motor()->exists()) { // mengecek apabila jenis kendaraannya motor
            $type = 'motor'; // apabila benar motor, maka nilai $type dijadikan motor
        } else if ($vehicleData->truck()->exists()) { // mengecek apabila jenis kendaraannya truck
            $type = 'truck'; // apabila benar truck, maka nilai $type dijadikan truck
        }

        // menampilkan view updateVehicle.blade.php untuk menampilkan form update kendaraan
        return view('vehicles.updateVehicle', [
            // melakukan passing data yang diperlukan dalam view untuk ditampilkan
            'vehicleData' => $vehicleData,
            'type' => $type
        ]);
    }

    /* merupakan function yang digunakan untuk melakukan update terhadap data kendaraan tertentu berdasarkan
    parameter $vehicleId yang menyimpan id kendaraan dan juga $request yang menyimpan data-data kendaraan */
    function updateVehicle($vehicleId, Request $request)
    {
        // berfungsi untuk memvalidasi format data
        $request->validate([
            'model' => 'required',
            'tahun' => 'required',
            'jumlah_penumpang' => 'required|numeric',
            'manufaktur' => 'required',
            'harga' => 'required|numeric',
            'jenis' => 'required',
            'data1' => 'required|numeric',
            'data2' => 'required|numeric',
            'image' => 'image|file|max:2048'
        ]);

        // berfungsi untuk menyimpan gambar yang baru apabila terdapat input gambar yang baru
        $gambar = $request->old_image;
        if ($request->image) {
            Storage::delete($request->old_image);
            $gambar = $request->file('image')->store('images');
        }

        // berfungsi untuk melakukan proses update data kendaraan di database berdasarkan data jenis kendaraan
        if ($request->jenis == 'mobil') { // contoh: apabila jenis kendaraan mobil
            $vehicleData = Vehicle::with('car')->find($vehicleId); // maka diambil model yang memiliki jenis kendaraan mobil berdasarkan id kendaraan

            // menambahkan data ke database
            $vehicleData->model = $request->model;
            $vehicleData->tahun = $request->tahun;
            $vehicleData->jumlah_penumpang = $request->jumlah_penumpang;
            $vehicleData->manufaktur = $request->manufaktur;
            $vehicleData->harga = $request->harga;
            $vehicleData->gambar = $gambar;

            $vehicleData->save();

            $vehicleData->car()->update([
                'tipe_bbm' => $request->data1,
                'luas_bagasi' => $request->data2
            ]);
        } else if ($request->jenis == 'motor') {
            $vehicleData = Vehicle::with('motor')->find($vehicleId);

            $vehicleData->model = $request->model;
            $vehicleData->tahun = $request->tahun;
            $vehicleData->jumlah_penumpang = $request->jumlah_penumpang;
            $vehicleData->manufaktur = $request->manufaktur;
            $vehicleData->harga = $request->harga;
            $vehicleData->gambar = $gambar;

            $vehicleData->save();

            $vehicleData->motor()->update([
                'ukuran_bagasi' => $request->data1,
                'kapasitas_bensin' => $request->data2
            ]);
        } else if ($request->jenis == 'truck') {
            $vehicleData = Vehicle::with('truck')->find($vehicleId);

            $vehicleData->model = $request->model;
            $vehicleData->tahun = $request->tahun;
            $vehicleData->jumlah_penumpang = $request->jumlah_penumpang;
            $vehicleData->manufaktur = $request->manufaktur;
            $vehicleData->harga = $request->harga;
            $vehicleData->gambar = $gambar;

            $vehicleData->save();

            $vehicleData->truck()->update([
                'jumlah_ban' => $request->data1,
                'luas_kargo' => $request->data2
            ]);
        }

        // melakukan routing ke /vehicle
        return redirect('/vehicle');
    }

    // merupakan function untuk menampilkan detil-detil kendaraan. 
    function showVehicleDetails($vehicleId)
    {
        // mengambil data kendaraan tertentu berdasarkan parameter $vehicleId yang menyimpan data id kendaraan
        $vehicleData = Vehicle::where('id', $vehicleId)->first();

        // variabel untuk menyimpan jenis kendaraan
        $type = '';

        // proses pengecekan kondisional untuk menentukan jenis kendaraan
        if ($vehicleData->car) {
            $type = 'Mobil';
        } else if ($vehicleData->motor) {
            $type = 'Motor';
        } else if ($vehicleData->truck) {
            $type = 'Truck';
        }

        // mengambil seluruh data customer yang memiliki relasi dengan data kendaraan yang disimpan dalam variabel $vehicleData
        $customers = $vehicleData->customers;

        // menampilkan view showVehicleDetails.blade.php untuk menampilkan detil-detil data kendaraan tertentu
        return view('vehicles.showVehicleDetails', [
            // melakukan passing data-data yang diperlukan untuk ditampilkan dalam view
            'vehicleData' => $vehicleData,
            'type' => $type,
            'customers' => $customers
        ]);
    }
}
