@extends('main')

@section('title', 'Tambah Klub')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Klub /</strong> Edit Klub</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Edit Klub Baru</b></h1>
            </div>
        </div>
    </div>


    <div class="col-lg-8">
        <form action="/team/{{ $teams->id }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nama Klub</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $teams->name) }}" placeholder="Masukkan Nama Klub..." required>
                </div>
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group row mb-3">
                <label for="city" class="col-sm-2 col-form-label">Kota Klub</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                        name="city" value="{{ old('city', $teams->city) }}" placeholder="Masukkan Nama Kota..." required>
                </div>
            </div>
            @error('city')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <br>
            <div class="from-group mb-5">
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
                <a href="/team" class="btn bg-gradient-danger text-white">Kembali</a>
            </div>
        </form>
    </div>
@endsection
