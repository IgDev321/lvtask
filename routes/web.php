<?php

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
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth', 'name' => 'dashboard'], function() {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/country', [App\Http\Controllers\HomeController::class, 'country'])
        ->name('country');

    Route::get('/region', [App\Http\Controllers\HomeController::class, 'region'])
        ->name('region');

    Route::post('/create/country', [App\Http\Controllers\CountriesController::class, 'create'])->name('createCountry');
    Route::post('/create/region', [App\Http\Controllers\RegionController::class, 'create'])->name('createRegion');

    Route::get('/update/country/{id}', [App\Http\Controllers\HomeController::class, 'updateCountry'])->name('updateCountry');
    Route::get('/update/region/{id}/{country}', [App\Http\Controllers\HomeController::class, 'updateRegion'])->name('updateRegion');

    Route::put('/update/region', [App\Http\Controllers\RegionController::class, 'updateReg'])->name('updateReg');
    Route::put('/update/country', [App\Http\Controllers\CountriesController::class, 'updateC'])->name('updateC');

    Route::delete('/remove/region/{id}', [App\Http\Controllers\RegionController::class, 'destroy'])->name('removeReg');
    Route::delete('/remove/country/{id}', [App\Http\Controllers\CountriesController::class, 'destroy'])->name('removeC');

    Route::get('/all', [App\Http\Controllers\HomeController::class, 'show'])->name('showAll');

    Route::get('/search/{page?}', [App\Http\Controllers\HomeController::class, 'search'])->name('search');


});



