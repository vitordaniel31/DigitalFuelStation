<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BombaController;
use App\Http\Controllers\CombustivelController;

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
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'bomba'], function(){
	Route::get('/', [BombaController::class, 'index'])->name('bomba.index');
	Route::get('/create', [BombaController::class, 'create'])->name('bomba.create');
	Route::post('/', [BombaController::class, 'store'])->name('bomba.store');
	Route::get('/edit/{id}', [BombaController::class, 'edit'])->name('bomba.edit');
	Route::put('/update/{id}', [BombaController::class, 'update'])->name('bomba.update');
	Route::delete('/{id}', [BombaController::class, 'destroy'])->name('bomba.destroy');
	Route::put('/{id}', [BombaController::class, 'restore'])->name('bomba.restore');
});

Route::group(['prefix' => 'combustivel'], function(){
	Route::get('/', [CombustivelController::class, 'index'])->name('combustivel.index');
	Route::get('/create', [CombustivelController::class, 'create'])->name('combustivel.create');
	Route::post('/', [CombustivelController::class, 'store'])->name('combustivel.store');
	Route::get('/edit/{id}', [CombustivelController::class, 'edit'])->name('combustivel.edit');
	Route::put('/update/{id}', [CombustivelController::class, 'update'])->name('combustivel.update');
	Route::delete('/{id}', [CombustivelController::class, 'destroy'])->name('combustivel.destroy');
	Route::put('/{id}', [CombustivelController::class, 'restore'])->name('combustivel.restore');
});