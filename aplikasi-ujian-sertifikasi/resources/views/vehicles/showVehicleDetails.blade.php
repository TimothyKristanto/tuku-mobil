@extends('layouts.mainLayout')

@section('content')
<h1 class="mt-4">Detil Kendaraan</h1>

<img src="{{ asset('storage/'.$vehicleData->gambar) }}" class="w-50">
<h5>Model: {{ $vehicleData->model }} </h5>
<h5>Tahun: {{ $vehicleData->tahun }} </h5>
<h5>Jumlah Penumpang: {{ $vehicleData->jumlah_penumpang }} orang </h5>
<h5>Manufaktur: {{ $vehicleData->manufaktur }} </h5>
<h5>Harga: Rp {{ $vehicleData->harga }} </h5>
<h5>Jenis Kendaraan: {{ $type }} </h5>

@if ($type == 'Mobil')
<h5>Tipe BBM: RON {{ $vehicleData->car->tipe_bbm }} </h5>
<h5>Luas Bagasi: {{ $vehicleData->car->luas_bagasi }} liter </h5>
@elseif ($type == 'Motor')
<h5>Ukuran Bagasi: {{ $vehicleData->motor->ukuran_bagasi }} liter </h5>
<h5>Kapasitas Bensin: {{ $vehicleData->motor->kapasitas_bensin }} liter </h5>
@elseif ($type == 'Truck')
<h5>Jumlah Ban: {{ $vehicleData->truck->jumlah_ban }} </h5>
<h5>Luas Kargo: {{ $vehicleData->truck->luas_kargo }} liter </h5>
@endif

<h1 class="mt-4">All customers who ordered this vehicle</h1>

<table class="table table-hover table-dark mt-3">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No Telp</th>
            <th scope="col">ID Card</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    {{-- jangan tampilkan data customer apabila isi collection $customers kosong atau null --}}
    @if (!empty($customers))
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <th scope="row"> {{ $loop->iteration }} </th>
            <td> {{ $customer->nama }} </td>
            <td> {{ $customer->alamat }} </td>
            <td> {{ $customer->no_telp }} </td>
            <td> {{ $customer->id_card }} </td>
            <td><a href="/showCustomerDetails/{{ $customer->id }}" class="btn btn-primary">View</a></td>
        </tr>
        @endforeach

    </tbody>
    @endif

</table>

{{-- tampilkan notes tiada data customer yang ditemukan ketika collection $customers kosong --}}
@if (count($customers) == 0)
<h2 class="d-flex justify-content-center">Not a single customers found</h2>
@endif

@endsection