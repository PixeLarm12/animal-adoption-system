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

Route::apiResource('/users',  UserController::class)->names('users');
Route::apiResource('/adoptions',  AdoptionController::class)->names('adoptions');
Route::apiResource('/animals',  AnimalController::class)->names('animals');
Route::apiResource('/catalogs',  CatalogController::class)->names('catalogs');
