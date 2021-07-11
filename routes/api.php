<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MusicController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Public Routes
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

//Protected Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix'=>'admin', 'middleware' => ['auth','role_or_permission:admin']], function() {
        Route::post('addMusic', [MusicController::class,'store'])->middleware(['permission:store music']);;
    });

    Route::post('logout',[AuthController::class,'logout']);
    Route::get('playlist',[MusicController::class,'index']);
});
