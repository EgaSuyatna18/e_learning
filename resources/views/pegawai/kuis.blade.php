@extends('layout.masterPegawai')
@section('content')
    <h1 class="text-center my-4">Kuis</h1>
    <form action="/pegawai/{{ $kuis[0]->kelompok_id }}/submit" method="post">
        @csrf
        @for ($i = 0; $i < 20; $i++)
            <div class="border border-1 shadow shadow-lg rounded p-4 mb-4">
                <label>Soal {{ $i + 1 }}</label><br>
                <label type="text">{{ $kuis[$i]->soal }}</label>
                <div class="d-flex justify-content-evenly">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawab[{{ $i }}]" id="jawab1" value="1" required>
                        <label class="form-check-label" for="jawab1">
                            {{ $kuis[$i]->jawab1 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawab[{{ $i }}]" id="jawab2" value="2">
                        <label class="form-check-label" for="jawab2">
                            {{ $kuis[$i]->jawab2 }}
                        </label>
                    </div>
                </div>
                <div class="d-flex justify-content-evenly mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawab[{{ $i }}]" id="jawab3" value="3">
                        <label class="form-check-label" for="jawab3">
                            {{ $kuis[$i]->jawab3 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jawab[{{ $i }}]" id="jawab4" value="4">
                        <label class="form-check-label" for="jawab4">
                            {{ $kuis[$i]->jawab4 }}
                        </label>
                    </div>
                </div>
            </div>
        @endfor
        <button type="submit" class="btn btn-success form-control mb-5">Submit</button>
    </form>
@endsection