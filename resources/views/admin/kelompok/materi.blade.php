@extends('layout.masterAdmin')
@section('content')
<h1 class="text-center my-4">{{ $title }}</h1>
@if (isset($materi->ppt))
    <div class="border border-1 shadow shadow-lg rounded p-4 mb-4">
        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset('storage/' . $materi->ppt) }}' width='100%' height='500px' frameborder='0'></iframe>
    </div>
@endif
<div class="border border-1 shadow shadow-lg rounded p-4 mb-4">
    <form action="/kelompok/{{ $kelompok_id }}/ppt" method="post" enctype="multipart/form-data">
        @csrf
        <div class="my-3">
            <label>Power Point</label>
            <input type="file" name="ppt" class="form-control" onchange="this.form.submit()">
        </div>
    </form>
</div>

@if (isset($materi->video))
    <div class="border border-1 shadow shadow-lg rounded p-4 mb-4 text-center">
        <iframe width="560" height="315" frameborder="0" allowfullscreen=""   src="{{ asset('storage/' . $materi->video) }}"></iframe>
    </div>
@endif
<div class="border border-1 shadow shadow-lg rounded p-4 mb-4">
    <form action="/kelompok/{{ $kelompok_id }}/video" method="post" enctype="multipart/form-data">
        @csrf
        <div class="my-3">
            <label>Video</label>
            <input type="file" name="video" class="form-control" onchange="this.form.submit()">
        </div>
    </form>
</div>
@endsection