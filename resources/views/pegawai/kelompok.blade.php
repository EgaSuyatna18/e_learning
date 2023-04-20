@extends('layout.masterPegawai')
@section('content')
    <h1 class="text-center my-4">{{ $training->nama }}</h1>
    <p class="text-center mb-3">{{ $training->deskripsi }}</p>
    <div class="row d-flex justify-content-evenly">
        @foreach ($kelompoks as $kelompok)
            <div class="col-3 border border-1 shadow shadow-lg rounded p-4 m-3">
                <h3>{{ $kelompok->nama }}</h3>
                <p>{{ substr($kelompok->deskripsi, 0, 100) }}</p>
                <a href="/pegawai/{{ $kelompok->id }}/materi" class="btn btn-success">Next</a>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        {{ $kelompoks->links() }}
    </div>
@endsection