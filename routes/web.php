<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\PegawaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/', [AuthController::class, 'login']);
route::get('/logout', [AuthController::class, 'logout']);

route::get('/home', [AdminController::class, 'home']);

route::get('/pegawai', [UserController::class, 'index']);
route::post('/pegawai', [UserController::class, 'store']);
route::delete('/pegawai', [UserController::class, 'destroy']);
route::put('/pegawai/{pegawai}/update', [UserController::class, 'update']);

route::get('/training', [TrainingController::class, 'index']);
route::post('/training', [TrainingController::class, 'store']);
route::delete('/training', [TrainingController::class, 'destroy']);
route::put('/training/{training}/update', [TrainingController::class, 'update']);

route::get('/kelompok', [KelompokController::class, 'index']);
route::post('/kelompok', [KelompokController::class, 'store']);
route::delete('/kelompok', [KelompokController::class, 'destroy']);
route::put('/kelompok/{kelompok}/update', [KelompokController::class, 'update']);
route::get('/kelompok/{id}/materi', [KelompokController::class, 'materi']);
route::post('/kelompok/{kelompok_id}/ppt', [KelompokController::class, 'ppt']);
route::post('/kelompok/{kelompok_id}/video', [KelompokController::class, 'video']);
route::get('/kelompok/{kelompok_id}/kuis', [KelompokController::class, 'kuis']);
route::post('/kelompok/{kelompok_id}/store_kuis', [KelompokController::class, 'store_kuis']);

route::get('/beranda', [PegawaiController::class, 'index']);
route::get('/pegawai/training', [PegawaiController::class, 'training']);
route::get('/pegawai/{training}/kelompok', [PegawaiController::class, 'kelompok']);
route::get('/pegawai/{kelompok_id}/materi', [PegawaiController::class, 'materi']);
route::get('/pegawai/{kelompok_id}/kuis', [PegawaiController::class, 'kuis']);
route::post('/pegawai/{kelompok_id}/submit', [PegawaiController::class, 'submit']);