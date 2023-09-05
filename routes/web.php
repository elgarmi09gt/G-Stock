<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [AccueilController::class, 'index'])->name('index');


/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

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

    Route::prefix('/vente')->controller(VenteController::class)->name('vente.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('store');
        Route::post('/{vente}/reglement', 'reglement')->name('reglement');
        Route::get('/{vente}', 'show')->name('show');
        Route::post('/{vente}', 'addProduit')->name('sorties');
        Route::delete('', 'destroy')->name('destroy');
        Route::delete('/{vente}', 'supprimerEntree')->name('sortie.destroy');
        Route::get('/edit/{vente}', 'edit')->name('edit');
        Route::post('/edit/{vente}', 'update')->name('update');
    });

    Route::prefix('/user')->controller(UserController::class)->name('user.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('store');
        Route::delete('', 'destroy')->name('destroy');
        Route::get('/edit/{entree}', 'edit')->name('edit');
        Route::post('/edit/{entree}', 'update')->name('update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
