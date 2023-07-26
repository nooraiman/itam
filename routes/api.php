<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::group(['prefix'=>'v1','middleware'=>['auth']], function(){
//     // Route API Resources
//     Route::apiResources([
//         'categories' => CategoryController::class,
//         'manufacturers' => ManufacturerController::class,
//         'assets' => AssetController::class,
//     ], array("as" => "api")); // Add 'api' prefix to the route name ex: api.categories.index
// });