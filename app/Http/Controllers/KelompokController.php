<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\Materi;
use App\Models\Kuis;
use App\Models\Training;
use Storage;

class KelompokController extends Controller
{
    function index() {
        return view('admin.kelompok.index', [
            'title' => 'Data Kelompok',
            'trainings' => Training::all(),
            'kelompoks' => Kelompok::with('training')->get()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'training_id' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        Kelompok::create($validated);

        return redirect('/kelompok')->with('notify', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request) {
        Kelompok::where('id', $request->input('id'))->delete();

        return redirect('/kelompok')->with('notify', 'Berhasil Menghapus Data.');
    }
    
    function update(Request $request, Kelompok $kelompok) {
        $validated = $request->validate([
            'training_id' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $kelompok->update($validated);

        return redirect('/kelompok')->with('notify', 'Berhasil Mengubah Data.');
    }

    function materi($id) {
        return view('admin.kelompok.materi', [
            'title' => 'Data Materi',
            'kelompok_id' => $id,
            'materi' => Materi::where('kelompok_id', $id)->first()
        ]);
    }

    function ppt(Request $request, $kelompok_id) {
        $request->validate(['ppt' => 'required|max:10240|mimes:ppt,pptx']);

        $materi = Materi::where('kelompok_id', $kelompok_id)->first();

        if(!$materi) {
            $materi = Materi::create(['kelompok_id' => $kelompok_id]);
        }

        if(!isset($materi->ppt)) {
            $materi->update([
                'ppt' => $request->file('ppt')->store('ppt')
            ]);
        }else {
            Storage::delete($materi->ppt);
            $materi->update(['ppt' => $request->file('ppt')->store('ppt')]);
        }

        return redirect("/kelompok/$kelompok_id/materi")->with('notify', 'Berhasil Set PPT.');
    }

    function video(Request $request, $kelompok_id) {
        $request->validate(['video' => 'required|max:10240|mimes:mp4,webm']);

        $materi = Materi::where('kelompok_id', $kelompok_id)->first();

        if(!$materi) {
            $materi = Materi::create(['kelompok_id' => $kelompok_id]);
        }

        if(!isset($materi->video)) {
            $materi->update([
                'video' => $request->file('video')->store('video')
            ]);
        }else {
            Storage::delete($materi->video);
            $materi->update(['video' => $request->file('video')->store('video')]);
        }

        return redirect("/kelompok/$kelompok_id/materi")->with('notify', 'Berhasil Set Video.');
    }

    function kuis($kelompok_id) {
        $kuis = Kuis::where('kelompok_id', $kelompok_id)->get();

        return view('admin.kelompok.kuis', [
            'title' => 'Kuis',
            'kelompok_id' => $kelompok_id,
            'kuis' => $kuis
        ]);
    }

    function store_kuis(Request $request, $kelompok_id) {
        $validated = $request->validate([
            'soal.*' => 'required',
            'jawab1.*' => 'required', 
            'jawab2.*' => 'required', 
            'jawab3.*' => 'required', 
            'jawab4.*' => 'required', 
            'jawaban.*' => 'required'
        ]);

        $kuis = Kuis::where('kelompok_id', $kelompok_id)->get();

        if($kuis->count()) {
            for ($i=0; $i < 20; $i++) { 
                $kuis[$i]->update([
                    'soal' => $validated['soal'][$i],
                    'jawab1' => $validated['jawab1'][$i],
                    'jawab2' => $validated['jawab2'][$i],
                    'jawab3' => $validated['jawab3'][$i],
                    'jawab4' => $validated['jawab4'][$i],
                    'jawaban' => $validated['jawaban'][$i]
                ]);
            }
        }else {
            for ($i=0; $i < 20; $i++) { 
                Kuis::create([
                    'kelompok_id' => $kelompok_id,
                    'soal' => $validated['soal'][$i],
                    'jawab1' => $validated['jawab1'][$i],
                    'jawab2' => $validated['jawab2'][$i],
                    'jawab3' => $validated['jawab3'][$i],
                    'jawab4' => $validated['jawab4'][$i],
                    'jawaban' => $validated['jawaban'][$i]
                ]);
            }
        }

        return redirect("/kelompok/$kelompok_id/kuis")->with('notify', 'Berhasil Set Kuis.');
    }
}
