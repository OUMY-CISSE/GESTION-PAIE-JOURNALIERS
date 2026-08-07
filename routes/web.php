<?php

use App\Http\Controllers\AtelierController;
use App\Http\Controllers\Chef_de_quartController;
use App\Http\Controllers\ImportExcelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalierController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\Tarif_HoraireController;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('securite/login');
});



Route::controller(JournalierController::class)->group(function () {
    Route::get('ajouter', 'ajouter')->name('ajouter');
});

Route::controller(JournalierController::class)->group(function () {
    Route::get('lister', 'lister')->name('lister');
});


Route::controller(UserController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');

});

Route::middleware('auth')->group(function () {
    Route::get('journaliers', function () {
        return view('journaliers');
    })->name('journaliers');

    Route::controller(JournalierController::class)->prefix('journaliers')->group(function () {
        Route::get('','index')->name('journaliers');
        Route::get('add', 'add')->name('journaliers.add');
        Route::post('store', 'store')->name('journaliers.store'); 
        Route::get('show/{id}', 'show')->name('journaliers.show');
        Route::get('edit/{id}', 'edit')->name('journaliers.edit');
        Route::put('edit/{id}','update')->name('journaliers.update');
        Route::delete('destroy/{id}', 'destroy')->name('journaliers.destroy');
        Route::post('search', 'search')->name('journaliers.search');
    });

    Route::controller(Chef_de_quartController::class)->prefix('chef_de_quarts')->group(function () {
        Route::get('', 'index')->name('chef_de_quarts');
        Route::get('add', 'add')->name('chef_de_quarts.add');
        Route::post('store', 'store')->name('chef_de_quarts.store');
        Route::get('show/{id}', 'show')->name('chef_de_quarts.show');
        Route::get('edit/{id}', 'edit')->name('chef_de_quarts.edit');
        Route::put('edit/{id}','update')->name('chef_de_quarts.update');
        Route::delete('destroy/{id}', 'destroy')->name('chef_de_quarts.destroy');

    });

    Route::controller(AtelierController::class)->prefix('ateliers')->group(function () {
        Route::get('', 'index')->name('ateliers');
        Route::get('add', 'add')->name('ateliers.add');
        Route::post('store', 'store')->name('ateliers.store');
        Route::get('show/{id}', 'show')->name('ateliers.show');
        Route::get('edit/{id}', 'edit')->name('ateliers.edit');
        Route::put('edit/{id}','update')->name('ateliers.update');
        Route::delete('destroy/{id}', 'destroy')->name('ateliers.destroy');
    });


    Route::controller(Tarif_HoraireController::class)->prefix('tarif_horaires')->group(function () {
        Route::get('', 'index')->name('tarif_horaires');
        Route::get('add', 'add')->name('tarif_horaires.add');
        Route::post('store', 'store')->name('tarif_horaires.store');
        Route::get('show/{id}', 'show')->name('tarif_horaires.show');
        Route::get('edit/{id}', 'edit')->name('tarif_horaires.edit');
        Route::put('edit/{id}','update')->name('tarif_horaires.update');
        Route::delete('destroy/{id}', 'destroy')->name('tarif_horaires.destroy');
    });

    Route::controller(PointageController::class)->prefix('pointages')->group(function () {
        Route::get('/journaliers/pointages', 'index')->name('pointages');
        Route::get('add', 'add')->name('pointages.add');
        Route::get('search', 'search')->name('pointages.search');
        Route::post('store', 'store')->name('pointages.store');
        Route::get('getChefs_de_quart/{id}', 'getChefs_de_quart')->name('pointages.getChefs_de_quart');
        Route::get('show/{id}', 'show')->name('pointages.show');
        Route::delete('destroy/{id}', 'destroy')->name('pointages.destroy');
        Route::get('filterpaye',  'filterpaye')->name('pointages.filterpaye');
    });

    Route::get('/journaliers/pointages/pointage', [App\Http\Controllers\PointagesController::class, 'pointage'])->name('pointages.pointage');
    Route::get('recapitulatif', [App\Http\Controllers\PointagesController::class, 'recapitulatif'])->name('pointages.recapitulatif');
    Route::get('searchPointage', [App\Http\Controllers\PointagesController::class, 'searchPointage'])->name('pointages.searchPointage');
    Route::get('getChefs_de_quarts/{id}', [App\Http\Controllers\PointagesController::class, 'getChefs_de_quarts'])->name('pointages.getChefs_de_quarts');
    Route::get('getHeuresTravaillees', [App\Http\Controllers\PointagesController::class, 'getHeuresTravaillees'])->name('pointages.getHeuresTravaillees');
    Route::post('storePointage', [App\Http\Controllers\PointagesController::class, 'storePointage'])->name('pointages.storePointage');
    Route::get('showPointage/{id}', [App\Http\Controllers\PointagesController::class, 'showPointage'])->name('pointages.showPointage');
    Route::delete('destroyPointage/{id}', [App\Http\Controllers\PointagesController::class, 'destroyPointage'])->name('pointages.destroyPointage');


    Route::get('facturation', [\App\Http\Controllers\PointagesController::class, 'index'])->name('pointages.facturation');
    Route::post('/filter', [\App\Http\Controllers\PointagesController::class, 'filter'])->name('pointages.filter');


    Route::controller(ImportExcelController::class)->prefix('excels')->group(function () {
        Route::get('', 'index')->name('excels');
        Route::post('import', 'import')->name('excels.import');
        Route::delete('destroy', 'destroy')->name('excels.destroy');
        Route::get('filtertableau',  'filtertableau')->name('excels.filtertableau');
        
    });
});


