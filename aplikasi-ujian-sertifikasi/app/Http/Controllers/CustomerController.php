<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

/* kelas ini merupakan controller yang digunakan untuk menghubungkan view yang berhubungan dengan customer, 
contohnya seperti customer.blade.php, addCustomer.blade.php, updateCustomer.blade.php, 
dan showCustomerDetails.blade.php, dengan kelas model Customer.php */

class CustomerController extends Controller
{
    // function di bawah ini berfungsi untuk menunjukkan view customer.blade.php ketika dipanggil saat routing
    function index()
    {
        // kode di bawah berfungsi untuk mengambil semua data customer
        $customers = Customer::all();

        // kode di bawah berfungsi untuk menampilkan view customer.blade.php untuk menampilkan seluruh data singkat customer
        return view('customers/customer', [
            'customers' => $customers // passing variable customers ke dalam view, agar bisa ditampilkan datanya
        ]);
    }

    // function di bawah ini berfungsi untuk menunjukkan view addCustomer.blade.php ketika dipanggil saat routing
    function addCustomerView()
    {
        // kode di bawah ini berfungsi untuk menampilkan view addCustomer.blade.php untuk menampilkan form tambah customer
        return view('customers/addCustomer', []);
    }

    /* function di bawah ini berfungsi untuk memproses dan menambahkan 
    data customer ke database ketika dipanggil saat routing. Data-data customer ditampung
    pada parameter $request yang digunakan dalam function ini. Parameter $request didapatkan 
    dari route parameter */
    function addCustomer(Request $request)
    {
        // kode di bawah ini berfungsi sebagai validator data, agar format data sesuai yang diinginkan
        $customerData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'id_card' => 'required|numeric'
        ]);

        // kode di bawah akan menyimpan data customer pada database
        Customer::create($customerData);

        // kode ini akan melakukan routing ke /customer
        return redirect('/customer');
    }

    /* function di bawah berfungsi untuk menghapus data customer. Maka dari itu, dibutuhkan
    data id customer untuk mengetahui customer mana yang akan dihapus datanya. Data id customer
    didapatkan dari parameter $customerId. */
    function deleteCustomer($customerId)
    {
        // kode di bawah akan menghapus data customer di database berdasarkan id customer 
        Customer::destroy($customerId);

        // kode ini melakukan routing ke /customer
        return redirect('/customer');
    }

    /* function di bawah berfungsi untuk menampilkan view updateCustomer.blade.php saat dipanggil
    melalui proses routing. Parameter $customerId menyimpan data id customer yang digunakan dalam 
    view ini untuk menunjukkan data-data lama customer sebelum diupdate */
    function updateCustomerView($customerId)
    {
        // kode ini berfungsi untuk mengambil data customer yang ingin ditampilkan pada view
        $customerData = Customer::where('id', $customerId)->first();

        // kode di bawah ini berfungsi menampilkan view updateCustomer.blade.php untuk menampilkan form update customer
        return view('customers/updateCustomer', [
            'customerData' => $customerData // passing data customer ke dalam view untuk ditampilkan
        ]);
    }

    /* function di bawah berfungsi untuk melakukan update terhadap data customer di database. 
    Maka dibutuhkan data id customer untuk mengetahui customer mana yang akan diupdate datanya. 
    Data id customer ini didapatkan dari parameter $customerId */
    function updateCustomer($customerId, Request $request)
    {
        // kode di bawah berfungsi sebagai validator data, agar format data sesuai yang diinginkan
        $customerData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'id_card' => 'required|numeric'
        ]);

        // kode di bawah melakukan update data terhadap data customer yang diinginkan
        Customer::where('id', $customerId)->update($customerData);

        // kode di bawah melakukan routing ke /customer
        return redirect('/customer');
    }

    /* function di bawah ini akan menunjukkan view showCustomerDetails.blade.php 
    ketika dipanggil saat proses routing. Parameter $customerId menyimpan data id customer
    yang berfungsi untuk mengambil data customer tertentu */
    function showCustomerDetails($customerId)
    {
        // kode di bawah mengambil data customer tertentu berdasarkan data id customer
        $customerData = Customer::where('id', $customerId)->first();

        /* kode di bawah ini mengambil seluruh data vehicles atau kendaraan yang memiliki relasi 
        dengan data customer yang disimpan dalam variabel $customerData */
        $vehicles = $customerData->vehicles;

        // melakukan debug dengan dd untuk mengetahui isi variabel $vehicles
        // dd($vehicles);

        /* array di bawah ini digunakan untuk menyimpan jenis-jenis kendaraan yang terdapat dalam variabel
        $vehicles, contohnya seperti mobil, motor, maupun truck */
        $types = [];

        // variabel ini digunakan untuk menyimpan total harga kendaraan yang dibeli customer
        $totalPrice = 0;

        /* melakukan looping pada variabel $vehicles yang bertipe collection 
        untuk bisa mengambil data jenis kendaraan pada masing-masing kelas Vehicle yang tersimpan
        dalam collection tersebut */
        foreach ($vehicles as $vehicle) {

            /* melakukan pengecekan kondisional untuk mengetahui data jenis kendaraan */
            if ($vehicle->car) { // bila data jenis kendaraan bertipe mobil tidak memberikan null ketika dipanggil 
                array_push($types, 'Mobil'); // maka tambahkan string jenis kendaraan Mobil ke dalam array $types
            } else if ($vehicle->motor) { // bila data jenis kendaraan bertipe motor tidak memberikan null ketika dipanggil 
                array_push($types, 'Motor'); // maka tambahkan string jenis kendaraan Motor ke dalam array $types
            } else if ($vehicle->truck) { // bila data jenis kendaraan bertipe truck tidak memberikan null ketika dipanggil 
                array_push($types, 'Truck'); // maka tambahkan string jenis kendaraan Truck ke dalam array $types
            }

            // tambahkan data harga kendaraan pada variabel $totalPrice
            $totalPrice += $vehicle->harga;
        }

        // menampilkan view showCustomerDetails.blade.php untuk menampilkan detil-detil data customer tertentu
        return view('customers.showCustomerDetails', [
            // passing seluruh data yang dibutuhkan ke dalam view untuk ditampilkan
            'customerData' => $customerData,
            'vehicles' => $vehicles,
            'types' => $types,
            'totalPrice' => $totalPrice
        ]);
    }
}
