<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReactController;
use App\Http\Controllers\StorageFileController;
use App\Models\React;
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

#post-react
Route::post('/posts/{id}/like', [ReactController::class, 'like']);
Route::post('/posts/{id}/dislike', [ReactController::class, 'dislike']);

#img route
Route::get('image/{filename}', [StorageFileController::class, 'getBlogImgs'])->name('displayBlogImage');

Route::middleware(['authMiddleware'])->group(function () {

    #posts
    Route::resource('/posts', PostController::class);

    #users
    Route::resource('/users', UserController::class);

    #categories
    Route::resource('/categories', CategoryController::class);

    #post-comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']);
    Route::put('/posts/{post_id}/comments/{comment_id}', [CommentController::class, 'changeCommentStatus']);
});

#auth
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
