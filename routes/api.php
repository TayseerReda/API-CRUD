<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Validation\ValidationException;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('posts',[PostController::class,'index']);
    Route::get('posts/{post}',[PostController::class,'show']);
    Route::post('posts/',[PostController::class,'store']);
    Route::put('posts/{post}/update',[PostController::class,'update']);
    Route::delete('posts/{post}',[PostController::class,'destroy']);
    Route::post('logout',[AuthController::class,'logout']);
});


