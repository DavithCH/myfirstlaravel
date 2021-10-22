<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'index'])->name('postList');
Route::get('/posts/create', [PostController::class, 'addPost'])->name('addPost');
Route::get('posts/{id}', [PostController::class, 'show'])->name('postDetails');
Route::post('/posts',[PostController::class, 'store'] );
Route::delete('/posts/{id}',[PostController::class, 'deletePost'])->name('deletePost');
Route::put('/posts/{id}',[PostController::class, 'updatePost'])->name('updatePost');
Route::put('/posts/{id}/image',[PostController::class, 'updatePostPicture'])->name('updatePostPicture');
Route::post('/posts/{postId}/comments',[CommentController::class, 'store'])->name('addComment');

Route::delete('/comments/{id}',[CommentController::class, 'delete'])->name('deleteComment');
Route::get('/categories',[CategoryController::class, 'index'])->name('listCategories');
Route::get('/categories/create',[CategoryController::class, 'add'])->name('createCategory');
Route::post('/categories/create',[CategoryController::class, 'store'])->name('storeCategory');
Route::delete('/categories/delete/{id}',[CategoryController::class, 'delete'])->name('deleteCategory');
Route::put('/categories/edit/{id}',[CategoryController::class, 'update'])->name('updateCategory');
