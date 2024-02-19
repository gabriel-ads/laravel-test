<?php

use App\Http\Controllers\RedirectsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('redirects')->group(function () {
    Route::get('/', [RedirectsController::class, 'index'])->name('redirects-index');
    Route::get('/create', [RedirectsController::class, 'create'])->name('redirects-create');
    Route::post('/', [RedirectsController::class, 'store'])->name('web-redirects-store');
});
