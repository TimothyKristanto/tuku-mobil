@extends('layouts.mainLayout')

@section('content')
<h1 class="mt-4">Seluruh data customer</h1>

<h5 class="mt-4"><a href="/addCustomer">Tambah customer</a></h5>
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
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <th scope="row"> {{ $loop->iteration }} </th>
            <td> {{ $customer->nama }} </td>
            <td> {{ $customer->alamat }} </td>
            <td> {{ $customer->no_telp }} </td>
            <td> {{ $customer->id_card }} </td>
            <td>
                <a href="/showCustomerDetails/{{ $customer->id }}" class="btn btn-primary">View</a>
                <a href="/updateCustomer/{{ $customer->id }}" class="btn btn-secondary">Update</a>
                <form action="/deleteCustomer/{{ $customer->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf

                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection