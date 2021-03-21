<?php

use App\Http\Controllers\EstablishmentController;
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

Route::get('/', function () {
    return redirect()->route('establishments.index');
});

Route::get('establishments', [EstablishmentController::class, 'index'])->name('establishments.index');
Route::get('establishments-web-search', [EstablishmentController::class, 'search'])->name('establishments.search');
