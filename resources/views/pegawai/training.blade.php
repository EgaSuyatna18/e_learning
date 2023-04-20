@extends('layout.masterPegawai')
@section('content')
    <h1 class="text-center my-4">{{ $title }}</h1>
    <div class="row d-flex justify-content-evenly">
        @foreach ($trainings as $training)
            <div class="col-3 border border-1 shadow shadow-lg rounded p-4 m-3">
                <h3>{{ $training->nama }}</h3>
                <p>{{ substr($training->deskripsi, 0, 100) }}</p>
                <p class="text-end">{{ $training->periode }}</p>
                <a href="/pegawai/{{ $training->id }}/kelompok" class="btn btn-success">Next</a>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        {{ $trainings->links() }}
    </div>
@endsection