<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/update_profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/posts/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');


Route::post('/comments/create', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::post('/likes/create', [App\Http\Controllers\LikeController::class, 'store'])->name('like.store');

Route::post('/follow/create', [App\Http\Controllers\FollowController::class, 'store'])->name('follow.store');

