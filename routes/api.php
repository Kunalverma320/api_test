<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\AdminMiddleware;
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





Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
    Route::get('admin', function (Request $request) {
        return $request->user();
    });
    Route::post('post/register',[PostController::class,'register'])->name('post.regisetr');

});



Route::post('/user/register',[UserController::class,'userregister'])->name('user.register');
Route::post('/user/login',[UserController::class,'userlogin'])->name('user.login');





