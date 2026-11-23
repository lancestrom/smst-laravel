<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfilSekolahController;
use App\Http\Controllers\Api\VisiSekolahController;
use App\Http\Controllers\Api\MisiSekolahController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\JurusanVisiController;
use App\Http\Controllers\Api\JurusanMisiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('profil-sekolah', ProfilSekolahController::class);
Route::apiResource('visi-sekolah', VisiSekolahController::class);
Route::apiResource('misi-sekolah', MisiSekolahController::class);
Route::apiResource('jurusan-sekolah', JurusanController::class);
Route::apiResource('jurusan-visi', JurusanVisiController::class);
Route::apiResource('jurusan-misi', JurusanMisiController::class);
