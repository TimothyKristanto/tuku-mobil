@extends('layouts.mainLayout')

@section('content')
<h1>Update pesanan</h1>

<form action="/updateOrder/{{ $pivotId }}/{{ $customerData->id }}" method="POST" class="mt-5">
    @method('put')
    @csrf

    <div class="mb-3">
        <label for="customer_id" class="form-label">Nama Customer - ID Card</label>
        <select class="form-select @error('customer_id') is-invalid @enderror" name="customer_id" id="customer_id"
            aria-describedby="customer_id_error_feedback" disabled>
            <option disabled selected value="{{ $customerData->id }}"> {{ $customerData->nama }} - {{
                $customerData->id_card }}
            </option>
        </select>
        @error('customer_id')
        <div id="customer_id_error_feedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="vehicle_id" class="form-label">Model Kendaraan - Tahun Kendaraan - Manufaktur Kendaraan</label>
        <select class="form-select @error('vehicle_id') is-invalid @enderror" name="vehicle_id" id="vehicle_id"
            aria-describedby="vehicle_id_error_feedback">
            @foreach ($vehicles as $vehicle)
            <option @selected($vehicleData->id == $vehicle->id) value="{{ $vehicle->id }}">{{ $vehicle->model }} - {{
                $vehicle->tahun }} - {{
                $vehicle->manufaktur
                }}</option>
            @endforeach
        </select>
        @error('vehicle_id')
        <div id="vehicle_id_error_feedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary d-flex w-100 justify-content-center">
        Submit
    </button>
</form>
@endsection