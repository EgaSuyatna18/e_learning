<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Kelompok;
use App\Models\Materi;
use App\Models\Kuis;

class PegawaiController extends Controller
{
    function index() {
        return view('pegawai.beranda', ['title' => 'Beranda']);
    }

    function training() {
        return view('pegawai.training', [
            'title' => 'Training',
            'trainings' => Training::paginate(6)
        ]);
    }

    function kelompok(Training $training) {
        return view('pegawai.kelompok', [
            'title' => 'Kelompok',
            'training' => $training,
            'kelompoks' => Kelompok::where('training_id', $training->id)
            ->whereHas('materi', function(Builder $query) {
                $query->whereNotNull('ppt')->whereNotNull('video');
            })->has('kuis')->paginate(6)
        ]);
    }

    function materi($kelompok_id) {
        return view('pegawai.materi', [
            'title' => 'Materi',
            'materi' => Materi::where('kelompok_id', $kelompok_id)->first()
        ]);
    }

    function kuis($kelompok_id) {
        return view('pegawai.kuis', [
            'title' => 'Kuis',
            'kuis' => Kuis::where('kelompok_id', $kelompok_id)->get()
        ]);
    }

    function submit(Request $request, $kelompok_id) {
        $validated = $request->validate(['jawab.*' => 'required']);
        $kuis = Kuis::where('kelompok_id', $kelompok_id)->get();
        $benar = 0;
        for ($i=0; $i < 20; $i++) { 
            if($kuis[$i]->jawaban == $validated['jawab'][$i]) {
                $benar += 5;
            }
        }

        dd($benar);
    }
}
