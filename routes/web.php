<?php

use App\Http\Controllers\ContohController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//tampilan depan
Route::get('/pegawai',[ContohController::class, 'index'])->name('pegawai');

//tambah data
Route::get('/tambahpegawai',[ContohController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata',[ContohController::class, 'insertdata'])->name('insertdata');

//update data
Route::get('/tampildata/{id}',[ContohController::class, 'tampildata'])->name('tampildata');
Route::post('/updatedata/{id}',[ContohController::class, 'updatedata'])->name('updatedata');

//delete data
Route::get('/delete/{id}',[ContohController::class, 'delete'])->name('delete');

//export pdf
Route::get('/exportpdf',[ContohController::class, 'exportpdf'])->name('exportpdf');
//export excel
Route::get('/exportexcel',[ContohController::class, 'exportexcel'])->name('exportexcel');
