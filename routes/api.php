<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register',[ApiController::class,'register']);
Route::post('/login',[ApiController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::apiresource('/post',PostController::class);
});
Route::post('/logout',[ApiController::class, 'logout']);

Route::apiResource('/categories',CategoryController::class);
Route::apiResource('/products',ProductController::class);

Route::middleware('jwt')->group(function(){
    Route::get('/test', function(){
        return '<h1>Api is working</h1>';
    });

});

// Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);
