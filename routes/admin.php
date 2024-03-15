<?php
namespace App\Providers;

use App\Http\Controllers\Admin\PostController as AdminPostController;;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.admin')->group(function () {
    Route::get('/welcome', function () {
        return view('admin.layout.master');
    })->name('welcome');

    Route::controller(AdminUserController::class)->name('users.')->prefix('users') ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/change_password', 'changePassword')->name('change_password');
        Route::get('/{user}/show', 'show')->name('show');
    });

    Route::controller(AdminPostController::class)->name('posts.')->prefix('posts') ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/upload/image', 'uploadImage')->name('upload_image');
        Route::post('/update/status/{post_id}', 'updateStatus')->name('update_status');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{post_id}', 'show')->name('show');
        Route::get('/edit/{post_id}', 'edit')->name('edit');
        Route::get('/{user}/destroy', 'destroy')->name('destroy');
    });
});