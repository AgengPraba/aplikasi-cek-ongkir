<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect('/index');
});

Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('/api/getCities/{province_id}', [HomeController::class, 'getCities'])->name('api.getCities');
Route::post('/cekOngkir', [HomeController::class, 'cekOngkir'])->name('cekOngkir');