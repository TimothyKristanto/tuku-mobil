@extends("layouts.mainLayout")

@section('content')
<h1 class="mt-4">Seluruh pesanan kendaraan</h1>

<table class="table table-hover table-dark mt-3">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No Telp</th>
            <th scope="col">ID Card</th>
            <th scope="col">Kendaraan yang Dibeli</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php
        $iteration = 1;
        @endphp
        @foreach ($customers as $customer)
        @foreach ($customer->vehicles as $vehicle)
        <tr>
            <th scope="row"> {{ $iteration }} </th>
            <td> {{ $customer->nama }} </td>
            <td> {{ $customer->alamat }} </td>
            <td> {{ $customer->no_telp }} </td>
            <td> {{ $customer->id_card }} </td>
            <td> {{ $vehicle->manufaktur }} {{ $vehicle->model }} {{ $vehicle->tahun }} </td>
            <td><a href="/showCustomerDetails/{{ $customer->id }}" class="btn btn-primary">View</a></td>
        </tr>
        @php
        $iteration++;
        @endphp
        @endforeach
        @endforeach
    </tbody>
</table>
@endsection