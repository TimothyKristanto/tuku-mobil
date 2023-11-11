@extends('layouts.mainLayout')

@section('content')
<h1 class="mt-4">Tambah kendaraan</h1>

<form action="/addVehicle" method="POST" class="mt-5" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="model" class="form-label">Model</label>
        <input type="model" class="form-control @error('model') is-invalid @enderror" id="model" name="model"
            value="{{ old('model') }}">
        @error('model')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tahun" class="form-label">Tahun</label>
        <input type="tahun" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun"
            value="{{ old('tahun') }}">
        @error('tahun')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="jumlah_penumpang" class="form-label">Jumlah Penumpang</label>
        <input type="jumlah_penumpang" class="form-control @error('jumlah_penumpang') is-invalid @enderror"
            id="jumlah_penumpang" name="jumlah_penumpang" value="{{ old('jumlah_penumpang') }}">
        @error('jumlah_penumpang')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="manufaktur" class="form-label">Manufaktur</label>
        <input type="manufaktur" class="form-control @error('manufaktur') is-invalid @enderror" id="manufaktur"
            name="manufaktur" value="{{ old('manufaktur') }}">
        @error('manufaktur')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
            value="{{ old('harga') }}">
        @error('harga')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Gambar</label>
        <img class="img-fluid img-preview mb-2 w-25">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
            aria-describedby="image_error_feedback" onchange="showPreviewImage()">
        @error('image')
        <div id="image_error_feedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="jenis" class="form-label">Jenis Kendaraan</label>
        <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" id="jenis"
            aria-describedby="jenisErrorFeedback" onchange="handler(this.value)" onload="handler(this.value)">
            <option @selected(old('jenis')=='mobil' ) value="mobil">Mobil</option>
            <option @selected(old('jenis')=='motor' ) value="motor">Motor</option>
            <option @selected(old('jenis')=='truck' ) value="truck">Truck</option>
        </select>
        @error('jenis')
        <div id="jenisErrorFeedback" class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3" id="container1">
        <label for="data1" class="form-label" id="labelData1">Tipe BBM RON</label>
        <input type="data1" class="form-control @error('data1') is-invalid @enderror" id="data1" name="data1"
            value="{{ old('data1') }}" id="data1">
        @error('data1')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="mb-3" id="container2">
        <label for="data2" class="form-label" id="labelData2">Luas Bagasi</label>
        <input type="data2" class="form-control @error('data2') is-invalid @enderror" id="data2" name="data2"
            value="{{ old('data2') }}" id="data2">
        @error('data2')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>



    <button type="submit" class="btn btn-primary d-flex w-100 justify-content-center mb-4">
        Submit
    </button>

    <script>
        // prosedur yang dijalankan ketika value atau isi input form jenis kendaraan berganti
        // prosedur ini akan mengubah tampilan form secara otomatis bergantung pada nilai input form jenis kendaraan
        function handler(val) {
            if (val === 'mobil') {
                document.getElementById('labelData1').innerHTML = 'Tipe BBM RON';
                document.getElementById('labelData2').innerHTML = 'Luas Bagasi';
                document.getElementById('data1').value = '';
                document.getElementById('data2').value = '';
            } else if (val === 'motor') {
                document.getElementById('labelData1').innerHTML = 'Ukuran Bagasi';
                document.getElementById('labelData2').innerHTML = 'Kapasitas Bensin';
                document.getElementById('data1').value = '';
                document.getElementById('data2').value = '';
            } else if (val === 'truck') {
                document.getElementById('labelData1').innerHTML = 'Jumlah Ban';
                document.getElementById('labelData2').innerHTML = 'Luas Kargo';
                document.getElementById('data1').value = '';
                document.getElementById('data2').value = '';
            }
        }

        // prosedur yang digunakan untuk menampilkan preview gambar dari input form gambar kendaraan
        // prosedur dipanggil ketika nilai input form gambar berubah
        function showPreviewImage() {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');

            console.log(image);

            imagePreview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
</form>
@endsection