<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ImageController;

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
    return view('dashboard');
});

Route::resource('brands', BrandController::class);
// Ajax Request
Route::get('/carsget/{id}',[CarController::class,'getModal']);
Route::get('/getImage',[CarController::class,'getCropImage']);

Route::resource('cars', CarController::class);
Route::resource('models', ModelController::class);

Route::get('carimages',[ImageController::class,'index'])->name('carimages.index');
Route::get('carimages/create',[ImageController::class,'create'])->name('carimages.create');
Route::get('carimages/{id}',[ImageController::class,'show'])->name('carimages.show');
Route::post('carimages',[ImageController::class,'store'])->name('carimages.store');
