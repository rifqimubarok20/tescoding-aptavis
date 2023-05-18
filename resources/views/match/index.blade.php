@extends('main')

@section('title', 'Pertandingan')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pertandingan</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-info alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{-- <button type="button" class="close" data-disniss="alert" aria-hidden="true">&times;</button> --}}
            <h5><i class="icon fa fa-check-square"></i> Berhasil!!!</h5>
            {{ session('success') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger alert-dismissible col-lg-12" role='alert'>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{-- <button type="button" class="close" data-disniss="alert" aria-hidden="true">&times;</button> --}}
            <h5><i class="icon fa fa-times-circle"></i> Gagal!!!</h5>
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex mb-3">
        <a href="/match/create" class="btn btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Pertandingan</span>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pertandingan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tuan Rumah</th>
                            <th>Tamu</th>
                            <th>Goal Tim Tuan Rumah</th>
                            <th>Goal Tim Tamu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($matches as $match)
                            <tr>
                                <td style="width: 5%">{{ $no++ }}</td>
                                <td>{{ $match->homeTeam->name }}</td>
                                <td>{{ $match->awayTeam->name }}</td>
                                <td>{{ $match->home_team_goals }}</td>
                                <td>{{ $match->away_team_goals }}</td>
                                <td>
                                    <a href="/match/{{ $match->id }}/edit" class="btn btn-circle btn-sm btn-warning"><i
                                            class="fa fa-edit"></i></a>
                                    <form action="/match/{{ $match->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-circle btn-sm btn-danger"
                                            onclick="return confirm('Yakin Mau Di Hapus?')"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
