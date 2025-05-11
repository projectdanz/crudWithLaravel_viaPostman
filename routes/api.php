<?php

use App\Http\Controllers\ApibukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('buku', [ApibukuController::class, 'index']);
Route::get('buku/{id}', [ApibukuController::class, 'show']);
Route::post('buku', [ApibukuController::class, 'store']);
Route::put('buku/{id}', [ApibukuController::class, 'update']);
