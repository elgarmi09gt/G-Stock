<?php

use App\Http\Controllers\AccueilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\ProduitController;

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

Route::get('/', [AccueilController::class,'index'])->name('index');

Route::prefix('/produit')->controller(ProduitController::class)->name('produit.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::delete('', 'destroy')->name('destroy');
    Route::get('/edit/{produit}', 'edit')->name('edit');
    Route::post('/edit/{produit}', 'update')->name('update');
});

Route::prefix('/client')->controller(ClientController::class)->name('client.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::delete('', 'destroy')->name('destroy');
    Route::get('/edit/{client}', 'edit')->name('edit');
    Route::post('/edit/{client}', 'update')->name('update');
});

Route::prefix('/entree')->controller(EntreeController::class)->name('entree.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::delete('', 'destroy')->name('destroy');
    Route::get('/edit/{entree}', 'edit')->name('edit');
    Route::post('/edit/{entree}', 'update')->name('update');
});
