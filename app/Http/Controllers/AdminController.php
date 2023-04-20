<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function home() {
        if(auth()->user()->akses == 'pegawai') {
            return redirect('/beranda');
        }
        return view('admin.home', ['title' => 'Home']);
    }
}
