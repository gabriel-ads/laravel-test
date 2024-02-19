<?php

use App\Http\Controllers\RedirectsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get', [RedirectsController::class, 'index']);
Route::post('/', [RedirectsController::class, 'store'])->name('redirects-store');
Route::put('/{id}', [RedirectsController::class, 'update'])->name('redirects-update');
Route::delete('/{id}', [RedirectsController::class, 'destroy'])->name('redirects-destroy');
