<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetModelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManufacturerController;

use Illuminate\Support\Facades\Route;

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
    return redirect()->route("dashboard");
});

Route::group(['middleware'=>['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middeware'=>['admin']], function() {
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('manufacturers', ManufacturerController::class)->except('show');
        Route::resource('models', AssetModelController::class);
        Route::resource('assets', AssetController::class);
    });
});



require __DIR__.'/auth.php';
