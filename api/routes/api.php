<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/catalogs',  CatalogController::class)->names('catalogs');
Route::apiResource('/users',  UserController::class)->only(['index', 'store', 'destroy'])->names('users');

Route::prefix('animals')->name('animals.')->group(function () {
    Route::get('/get-form-select-options', [AnimalController::class, 'getFormSelectOptions'])->name('getFormSelectOptions');
    Route::get('/', [AnimalController::class, 'index'])->name('index');
    Route::get('/{animal}', [AnimalController::class, 'show'])->name('show');
    Route::put('/{animal}', [AnimalController::class, 'update'])->name('update');
    Route::delete('/{animal}', [AnimalController::class, 'destroy'])->name('destroy');
    Route::post('/', [AnimalController::class, 'store'])->name('store');
});

Route::prefix('adoptions')->name('adoptions.')->group(function () {
    Route::get('/get-form-select-options/{animalId}', [AdoptionController::class, 'getFormSelectOptions'])->name('getFormSelectOptions');
    Route::get('/', [AdoptionController::class, 'index'])->name('index');
    Route::get('/{adoption}', [AdoptionController::class, 'show'])->name('show');
    Route::put('/{adoption}', [AdoptionController::class, 'update'])->name('update');
    Route::delete('/{adoption}', [AdoptionController::class, 'destroy'])->name('destroy');
    Route::post('/', [AdoptionController::class, 'store'])->name('store');
});
