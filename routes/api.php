<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

//public Routes
Route::get('/search',[App\Http\Controllers\SearchController::class,'RegionSearch'])->name('search');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Login
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//For API
Route::get('/Business/{id?}',[BusinessController::class,'getBusinesses']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']],function(){
    //logout user Sanctum
    Route::post('/logout',[AuthController::class,'logout']);

    //create
    Route::post('/Business',[BusinessController::class,'store']);
    Route::put('/Business/{id}',[BusinessController::class,'update']);    
    Route::delete('/Business/{id}',[BusinessController::class,'destroy']);   
});