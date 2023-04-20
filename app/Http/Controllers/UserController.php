<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index() {
        return view('admin.pegawai.index', [
            'title' => 'Data Pegawai',
            'pegawais' => User::all()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'tanggal_masuk' => 'required',
            'akses' => 'required'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/pegawai')->with('notify', 'Berhasil Menambah Data.');
    }

    function destroy(Request $request) {
        User::where('id', $request->input('id'))->delete();

        return redirect('/pegawai')->with('notify', 'Berhasil Menghapus Data.');
    }
    
    function update(Request $request, User $pegawai) {
        $rules = [
            'nik' => 'required',
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'tanggal_masuk' => 'required',
            'akses' => 'required'
        ];

        if($request->input('password')) $rules['password'] = 'required';

        $validated = $request->validate($rules);

        if($request->input('password')) $validated['password'] = Hash::make($validated['password']);

        $pegawai->update($validated);

        return redirect('/pegawai')->with('notify', 'Berhasil Mengubah Pegawai.');
    }
}
