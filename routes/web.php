<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/create', [PostController::class, 'showCreateForm']); // Страница создания поста
Route::post('/post', [PostController::class, 'create']); // Обработка создания поста

Route::get('/post/{postId}/edit', [PostController::class, 'showUpdateForm'])->name('post.edit');
Route::put('/post/{postId}', [PostController::class, 'update'])->name('post.update');
Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

Route::post('/posts/{id}/publish', [PostController::class, 'publishPost'])->name('post.public'); // Маршрут для публикации поста
Route::post('/posts/{id}/unpublish', [PostController::class, 'unPublishPost'])->name('post.unpublic'); // Маршрут для снятия с публикации поста

Route::post('posts/{postId}/comments', [CommentController::class, 'addComment'])->name('comment.add'); // Маршрут для создания комментария
Route::delete('comments/{id}', [CommentController::class, 'deleteComment'])->name('comment.delete'); // Маршрут для удаления комментария


// короче создать и редактировать может любой, а вот опубликовать только админ