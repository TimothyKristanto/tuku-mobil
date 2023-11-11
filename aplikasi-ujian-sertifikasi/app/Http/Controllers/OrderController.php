<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vehicle;

class OrderController extends Controller
{
    // function untuk menampilkan halaman home.blade.php ketika dipanggil saat routing
    function index()
    {
        // kode ini mengambil seluruh data customer
        $customers = Customer::all();

        // menampilkan view home.blade.php untuk menampilkan data singkat seluruh pesanan
        return view('home', [
            // passing data customer yang telah diambil tadi ke dalam view untuk ditampilkan
            'customers' => $customers
        ]);
    }

    /* function untuk menampilkan halaman addOrder.blade.php ketika dipanggil saat routing.
    parameter $customerId menampung data id customer yang digunakan untuk memanggil data customer
    tertentu */
    function addOrderView($customerId)
    {
        // kode ini memanggil data customer tertentu berdasarkan id customer
        $customer = Customer::where('id', $customerId)->first();

        // kode ini memanggil seluruh data kendaraan
        $vehicles = Vehicle::all();

        // kode di bawah akan menampilkan view addOrder.blade.php untuk menampilkan form tambah pesanan mobil
        return view('addOrder', [
            // melakukan passing data yang dibutuhkan untuk bisa ditampilkan dalam view
            'customer' => $customer,
            'vehicles' => $vehicles
        ]);
    }

    /* function di bawah ini berfungsi untuk memproses dan menambahkan 
    data pesanan mobil tiap customer ke database ketika dipanggil saat routing. 
    Data-data pesanan ditampung pada parameter $request yang digunakan dalam function ini. 
    Parameter $request didapatkan dari route parameter. Parameter $customerId menyimpan id customer
    yang akan digunakan untuk menambahkan pesanan mobil customer tertentu */
    function addOrder($customerId, Request $request)
    {
        // berfungsi sebagai validator agar format data sesuai yang diinginkan
        $request->validate([
            'vehicle_id' => 'required'
        ]);

        // berfungsi untuk mengambil data customer tertentu
        $customer = Customer::find($customerId);

        // berfungsi untuk menambahkan data pesanan mobil dari customer yang disimpan dalam variabel $customer
        $customer->vehicles()->attach($request->vehicle_id);

        // melakukan routing ke /showCustomerDetails dengan route parameter menggunakan data id customer
        return redirect('/showCustomerDetails/' . $customerId);
    }

    /* berfungsi untuk menghapus data pesanan tertentu. Parameter $pivotId menyimpan id pesanan dan 
    parameter $customerId menyimpan id customer. Kedua parameter akan berguna dalam menentukan pesanan
    mana yang akan dihapus */
    function deleteOrder($pivotId, $customerId)
    {
        // mengambil data user tertentu
        $customer = Customer::find($customerId);

        // menghapus data pesanan tertentu milik customer yang tersimpan dalam $customer
        $customer->vehicles()->wherePivot('id', $pivotId)->detach();

        // melakukan routing kembali ke halaman sebelumnya
        return back();
    }

    /* function ini berfungsi untuk menampilkan view updateOrder.blade.php. 3 parameter yang digunakan
    masing-masing adalah data id kendaraan, id customer, dan juga id pesanan. */
    function updateOrderView($vehicleId, $customerId, $pivotId)
    {
        // mengambil data kendaraan tertentu menggunakan data id kendaraan
        $vehicleData = Vehicle::where('id', $vehicleId)->first();

        // mengambil data customer tertentu menggunakan data id customer
        $customerData = Customer::where('id', $customerId)->first();

        // mengambil seluruh data kendaraan
        $vehicles = Vehicle::all();

        // menampilkan view upadteOrder.blade.php untuk menampilkan form update pesanan mobil
        return view('updateOrder', [
            // passing data-data yang diperlukan untuk ditampilkan dalam view
            'vehicleData' => $vehicleData,
            'customerData' => $customerData,
            'pivotId' => $pivotId,
            'vehicles' => $vehicles
        ]);
    }

    /* function ini berfungsi untuk melakukan update data pesanan. 3 parameter yang digunakan masing-masing
    merupakan data id pesanan, id customer, dan data mobil yang dipesan yang akan digunakan dalam proses
    update data pesanan */
    function updateOrder($pivotId, $customerId, Request $request)
    {
        // berfungsi sebagai validator format data, agar sesuai yang diinginkan
        $request->validate([
            'vehicle_id' => 'required'
        ]);

        // mengambil data customer tertentu menggunakan data id customer
        $customer = Customer::find($customerId);

        // menghapus data pesanan yang lama menggunakan data id pesanan
        $customer->vehicles()->wherePivot('id', $pivotId)->detach();

        // menambahkan data pesanan yang baru menggunakan data id kendaraan dan data pesanan berhasil diupdate
        $customer->vehicles()->attach($request->vehicle_id);

        // melakukan routing ke link /showCustomerDetails menggunakan route param id customer
        return redirect('/showCustomerDetails/' . $customerId);
    }
}
