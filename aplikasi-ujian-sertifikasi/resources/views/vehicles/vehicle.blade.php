@extends('layouts.mainLayout')

@section('content')
<h1 class="mt-4">Seluruh data kendaraan</h1>

<h5 class="mt-4"><a href="/addVehicle">Tambah kendaraan baru</a></h5>
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
                <a href="/updateVehicle/{{ $vehicle->id }}" class="btn btn-secondary">Update</a>
                <form action="/deleteVehicle/{{ $vehicle->id }}" method="post" class="d-inline">
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
</table>
@endsection