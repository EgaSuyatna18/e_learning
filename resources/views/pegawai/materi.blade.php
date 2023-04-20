@extends('layout.masterPegawai')
@section('content')
    <h1 class="text-center my-4">Materi</h1>
    
    <div class="border border-1 shadow shadow-lg rounded p-4 mb-4">
        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset('storage/' . $materi->ppt) }}' width='100%' height='500px' frameborder='0'></iframe>
    </div>

    <div class="border border-1 shadow shadow-lg rounded p-4 mb-4 text-center">
        <iframe width="560" height="315" frameborder="0" allowfullscreen=""   src="{{ asset('storage/' . $materi->video) }}"></iframe>
    </div>

    <div class="text-center">
        <a href="/pegawai/{{ $materi->kelompok_id }}/kuis" class="btn btn-success mb-5">Kerjakan Kuis</a>
    </div>
@endsection