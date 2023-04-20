@extends('layout.masterAdmin')
@section('content')
<h1 class="text-center my-4">{{ $title }}</h1>
<form action="/kelompok/{{ $kelompok_id }}/store_kuis" method="post">
    @csrf
    @for ($i = 0; $i < 20; $i++)
        <div class="border border-1 shadow shadow-lg rounded p-4 mb-4">
            <label>Soal {{ $i + 1 }}</label>
            <input type="text" name="soal[{{ $i }}]" class="form-control" value="{{ (isset($kuis[$i])) ? $kuis[$i]->soal : '' }}">
            <div class="d-flex justify-content-evenly">
                <input type="text" name="jawab1[{{ $i }}]" class="form-control m-3" value="{{ (isset($kuis[$i])) ? $kuis[$i]->jawab1 : '' }}" placeholder="jawaban 1">
                <input type="text" name="jawab2[{{ $i }}]" class="form-control m-3" value="{{ (isset($kuis[$i])) ? $kuis[$i]->jawab2 : '' }}" placeholder="jawaban 2">
            </div>
            <div class="d-flex justify-content-evenly">
                <input type="text" name="jawab3[{{ $i }}]" class="form-control m-3" value="{{ (isset($kuis[$i])) ? $kuis[$i]->jawab3 : '' }}" placeholder="jawaban 3">
                <input type="text" name="jawab4[{{ $i }}]" class="form-control m-3" value="{{ (isset($kuis[$i])) ? $kuis[$i]->jawab4 : '' }}" placeholder="jawaban 4">
            </div>
            <div class="my-2">
                <label>Jawaban Benar</label>
                <select name="jawaban[{{ $i }}]" class="form-control">
                    <option value="1">Jawaban 1</option>
                    <option value="2">Jawaban 2</option>
                    <option value="3">Jawaban 3</option>
                    <option value="4">Jawaban 4</option>
                </select>
            </div>
        </div>
    @endfor
    <button type="submit" class="btn btn-success form-control mb-5">Submit</button>
</form>
@endsection