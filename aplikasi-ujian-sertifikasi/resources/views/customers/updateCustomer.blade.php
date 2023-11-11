@extends('layouts.mainLayout')

@section('content')
<h1 class="mt-4">Update customer</h1>

<form action="/updateCustomer/{{ $customerData->id }}" method="POST" class="mt-5">
    @method('put')
    @csrf

    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
            value="{{ old('nama', $customerData->nama) }}">
        @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
            value="{{ old('alamat', $customerData->alamat) }}">
        @error('alamat')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="no_telp" class="form-label">No Telp</label>
        <input type="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp"
            value="{{ old('no_telp', $customerData->no_telp) }}">
        @error('no_telp')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="id_card" class="form-label">ID card</label>
        <input type="id_card" class="form-control @error('id_card') is-invalid @enderror" id="id_card" name="id_card"
            value="{{ old('id_card', $customerData->id_card) }}">
        @error('id_card')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary d-flex w-100 justify-content-center">
        Submit
    </button>
</form>
@endsection