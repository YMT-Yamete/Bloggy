<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

# main page
Route::get('/', [PostController::class, 'showList']);

#about
Route::get('/about', [AboutController::class, 'about']);

#show post details
Route::get('/posts/{id}/show', [PostController::class, 'showDetails']);

#add comment
Route::post('/posts/{id}/comments/', [CommentController::class, 'store']);

Route::middleware(['authMiddleware'])->group(function () {

    #posts
    Route::resource('/posts', PostController::class);

    #users
    Route::resource('/users', UserController::class);

    #categories
    Route::resource('/categories', CategoryController::class);

    #post-comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']);
    Route::put('/posts/{post_id}/comments/{comment_id}', [CommentController::class, 'denyComment']);
});

#auth
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
