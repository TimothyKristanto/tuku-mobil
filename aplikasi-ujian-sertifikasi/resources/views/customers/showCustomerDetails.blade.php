@extends('layouts.mainLayout')

@section('content')
<h1 class="mt-4">Detil customer</h1>

<h5>Nama: {{ $customerData->nama }} </h5>
<h5>Alamat: {{ $customerData->alamat }} </h5>
<h5>Nomor Telepon: {{ $customerData->no_telp }} </h5>
<h5>ID Card: {{ $customerData->id_card }} </h5>

<h1 class="mt-4">All Vehicles which are ordered by this customer</h1>

<h5 class="mt-4"><a href="/addOrder/{{ $customerData->id }}">Tambah kendaraan untuk customer ini</a></h5>
<table class="table table-hover table-dark mt-3">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Model</th>
            <th scope="col">Tahun</th>
            <th scope="col">Jumlah Penumpang</th>
            <th scope="col">Manufaktur</th>
            <th scope="col">Harga</th>
            <th scope="col">Jenis Kendaraan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    {{-- jangan tampilkan data kendaraan apabila isi collection $vehicles kosong atau null --}}
    @if (!empty($vehicles))
    <tbody>
        @php
        $types_index = 0;
        @endphp
        @foreach ($vehicles as $vehicle)
        <tr>
            <th scope="row"> {{ $loop->iteration }} </th>
            <td> {{ $vehicle->model }} </td>
            <td> {{ $vehicle->tahun }} </td>
            <td> {{ $vehicle->jumlah_penumpang }} </td>
            <td> {{ $vehicle->manufaktur }} </td>
            <td> {{ $vehicle->harga }} </td>
            <td> {{ $types[$types_index] }} </td>
            <td>
                <a href="/showVehicleDetails/{{ $vehicle->id }}" class="btn btn-primary">View</a>
                <a href="/updateOrder/{{ $vehicle->id }}/{{ $customerData->id }}/{{ $vehicle->pivot->id }}"
                    class="btn btn-secondary">Update</a>
                <form action="/deleteOrder/{{ $vehicle->pivot->id }}/{{ $customerData->id }}" method="post"
                    class="d-inline">
                    @method('delete')
                    @csrf

                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </td>
        </tr>

        @php
        $types_index++;
        @endphp
        @endforeach

    </tbody>
    @endif

</table>

{{-- tampilkan notes tiada data kendaraan yang ditemukan apabila isi collection $vehicles kosong atau null --}}
@if (count($vehicles) == 0)
<h2 class="d-flex justify-content-center">Not a single vehicle found</h2>
@endif

<h5> Total Harga: Rp {{ $totalPrice }} </h5>

@endsection