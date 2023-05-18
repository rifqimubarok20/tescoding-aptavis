@extends('main')

@section('title', 'Tambah Klub')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>Pertandingan /</strong> Tambah Pertandingan</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div
                class="d-flex justify-content-center flex-wrap flex-md-nowrapalign-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="text-center h2"> <b> Buat Pertandingan Baru</b></h1>
            </div>
        </div>
    </div>


    <div class="col-lg-8">
        <form action="/match" method="POST">
            @csrf
            <div class="form-group row mb-3">
                <div class="col">
                    <select class="custom-select  @error('name') is-invalid @enderror" id="home_team_id" name="home_team_id"
                        onchange="disableSelectedTeam(this.value, 'away_team_id')" required>
                        <option selected disabled>-Klub 1-</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-1 text-center">
                    <span>-</span>
                </div>
                <div class="col">
                    <select class="custom-select  @error('name') is-invalid @enderror" id="away_team_id" name="away_team_id"
                        onchange="disableSelectedTeam(this.value, 'home_team_id')" required>
                        <option selected disabled>-Klub 2-</option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <div class="form-group row mb-3">
                <div class="col-sm">
                    <input type="number" class="form-control @error('team_goals') is-invalid @enderror"
                        id="home_team_goals" name="home_team_goals" placeholder="Masukkan Skor klub 1..." required>
                </div>
                <div class="col-1 text-center">
                    <span>-</span>
                </div>
                <div class="col-sm">
                    <input type="number" class="form-control @error('team_goals') is-invalid @enderror"
                        id="away_team_goals" name="away_team_goals" placeholder="Masukkan Skor klub 2..." required>
                </div>
            </div>
            @error('team_goals')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <br>

            <div class="from-group mb-5">
                <button type="submit" class="btn bg-gradient-primary text-white">Simpan</button>
                <a href="/match" class="btn bg-gradient-danger text-white">Kembali</a>
            </div>
        </form>
    </div>
@endsection
