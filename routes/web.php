<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BombaController;
use App\Http\Controllers\CombustivelController;
use App\Http\Controllers\VendaController;
use App\Models\Combustivel;
use App\Models\Venda;

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
    $combustiveis = Combustivel::all();
    $vendas =  Venda::join('combustiveis_bombas', 'id_combustivel_bomba', '=', 'combustiveis_bombas.id')
    		->join('combustiveis', 'id_combustivel', '=', 'combustiveis.id')
    		->join('bombas', 'id_bomba', '=', 'bombas.id')
    		->get();    
    return view('index')->with('combustiveis', $combustiveis)->with('vendas', $vendas);
})->middleware('auth')->name('home');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'bomba', 'middleware' => 'auth'], function(){
	Route::get('/', [BombaController::class, 'index'])->name('bomba.index');
	Route::get('/create', [BombaController::class, 'create'])->name('bomba.create');
	Route::post('/', [BombaController::class, 'store'])->name('bomba.store');
	Route::get('/edit/{id}', [BombaController::class, 'edit'])->name('bomba.edit');
	Route::put('/update/{id}', [BombaController::class, 'update'])->name('bomba.update');
	Route::delete('/{id}', [BombaController::class, 'destroy'])->name('bomba.destroy');
	Route::put('/{id}', [BombaController::class, 'restore'])->name('bomba.restore');

});

Route::group(['prefix' => 'combustivel', 'middleware' => 'auth'], function(){
	Route::get('/', [CombustivelController::class, 'index'])->name('combustivel.index');
	Route::get('/abastecer/{id}', [CombustivelController::class, 'abastecer'])->name('combustivel.abastecer');
	Route::post('/abastecer/{id}', [CombustivelController::class, 'abastecimento'])->name('combustivel.abastecimento');
	Route::get('/create', [CombustivelController::class, 'create'])->name('combustivel.create');
	Route::post('/', [CombustivelController::class, 'store'])->name('combustivel.store');
	Route::get('/edit/{id}', [CombustivelController::class, 'edit'])->name('combustivel.edit');
	Route::put('/update/{id}', [CombustivelController::class, 'update'])->name('combustivel.update');
	Route::delete('/{id}', [CombustivelController::class, 'destroy'])->name('combustivel.destroy');
	Route::put('/{id}', [CombustivelController::class, 'restore'])->name('combustivel.restore');
});

Route::group(['prefix' => 'venda', 'middleware' => 'bomba'], function(){
	Route::get('/', [VendaController::class, 'index'])->name('venda.index');
	Route::post('/', [VendaController::class, 'store'])->name('venda.store');
});

Route::get('/bomba/login', [BombaController::class, 'createLogin'])
				->middleware('guest')
                ->name('bomba.createLogin');

Route::post('/bomba/login', [BombaController::class, 'storeLogin'])
                ->middleware('guest')
                ->name('bomba.storeLogin');

Route::post('/bomba/logout', [BombaController::class, 'destroyLogin'])
                ->name('bomba.logout');
