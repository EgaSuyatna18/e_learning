<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;
use App\Models\Materi;
use App\Models\Kuis;
use Storage;
use LaravelFileViewer;

class TrainingController extends Controller
{
    function index() {
        return view('admin.training.index', [
            'title' => 'Data Training',
            'trainings' => Training::all()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'periode' => 'required'
        ]);

        Training::create($validated);

        return redirect('/training')->with('notify', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request) {
        Training::where('id', $request->input('id'))->delete();

        return redirect('/training')->with('notify', 'Berhasil Menghapus Data.');
    }
    
    function update(Request $request, Training $training) {
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'periode' => 'required'
        ]);

        $training->update($validated);

        return redirect('/training')->with('notify', 'Berhasil Mengubah Pegawai.');
    }
}
