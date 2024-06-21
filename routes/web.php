<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;

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

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::get('/', function () {
        return view('dashboard.index');
    });

    Route::get('/presence', [AbsenController::class, 'index'])->name('presence');
    Route::get('/create-presence', [AbsenController::class, 'createPresence'])->name('create-presence');
    Route::post('/store-presence', [AbsenController::class, 'storePresence'])->name('store-presence');
    Route::get('/show-presence/{id}', [AbsenController::class, 'showPresence'])->name('show-presence');
    Route::post('/edit-presence/{id}', [AbsenController::class, 'editPresence'])->name('edit-presence');
    Route::get('/delete-presence/{id}', [AbsenController::class, 'deletePresence'])->name('delete-presence');

    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::get('/karyawan/{karyawan}', [KaryawanController::class, 'show']);
    Route::get('/dashboard/list-karyawan', [KaryawanController::class, 'list']);
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    Route::get('/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');

    Route::get('/shift', [ShiftController::class, 'index'])->name('shift.index');
    Route::get('/shift/create', [ShiftController::class, 'create'])->name('shift.create');
    Route::post('/shift', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('/shift/{shift}/edit', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::put('/shift/{shift}', [ShiftController::class, 'update'])->name('shift.update');
    Route::delete('/shift/{shift}', [ShiftController::class, 'destroy'])->name('shift.destroy');

    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::get('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
    Route::get('/jabatan/{jabatan}', [JabatanController::class, 'show']);
    Route::get('/dashboard/list-jabatan', [JabatanController::class, 'list']);
    Route::delete('/jabatan/delete/{id_jabatan}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
    Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('/jabatan/edit/{id_jabatan}', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::put('/jabatan/{id_jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');

    Route::get('/gaji', function () {
        return view('gaji', [
            'title' => 'Gaji'
        ]);
    });

    Route::resource('gaji', GajiController::class);
    Route::get('/dashboard/gaji', [GajiController::class, 'index']);
});

