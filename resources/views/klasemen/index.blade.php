@extends('main')

@section('title', 'Klasemen')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Klasemen</h1>
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
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Klasemen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Ma</th>
                            <th>Me</th>
                            <th>S</th>
                            <th>K</th>
                            <th>GM</th>
                            <th>GK</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($teams->sortByDesc('points') as $team)
                            <tr>
                                <td style="width: 5%">{{ $no++ }}</td>
                                <td style="width: 15%">{{ $team->name }}</td>
                                <td>{{ $team->played }}</td>
                                <td>{{ $team->wins }}</td>
                                <td>{{ $team->draws }}</td>
                                <td>{{ $team->losses }}</td>
                                <td>{{ $team->goals_for }}</td>
                                <td>{{ $team->goals_against }}</td>
                                <td>{{ $team->points }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
