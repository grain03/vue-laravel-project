<?php

use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Profile\ProfileController;
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


Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/signup', [AuthController::class, 'register'])->name('signup');
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('/posts')->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    
    Route::get('/show/{id}', [PostController::class, 'show'])->name('posts.show');

    Route::middleware('auth:sanctum')->post('/store', [PostController::class, 'store'])->name('posts.store');

    Route::middleware('auth:sanctum')->patch('/update/{id}', [PostController::class, 'update'])->name('posts.update');
    
    Route::middleware('auth:sanctum')->delete('/delete/{id}', [PostController::class,'delete'])->name('posts.delete');
});

Route::prefix('/profile')->group(function () {
    Route::middleware('auth:sanctum')->get('/', [ProfileController::class, 'index'])->name('profile.index');

    Route::middleware('auth:sanctum')->post('/EditProfile', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::middleware('auth:sanctum')->get('/TokenValidation', function(){
    return true;
});
