<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Artisan;

Route::get('', [HomeController::class, 'index'])->name('admin.home');
Route::resource('categories', CategoryController::class)->names('admin.categories');
Route::resource('tags', TagController::class)->names("admin.tags");

Route::resource('posts', PostController::class)->names("admin.posts");

Route::get('slc', function () {
    Artisan::call('storage:link');
});
