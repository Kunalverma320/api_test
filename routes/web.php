<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/apitest', function () {
    return view('apifatch');
});

Route::get('/',[AuthController::class,'index'])->name('post.register');
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('page.dashboard');
Route::get('/post/register',[PostController::class,'index'])->name('post.register');

