<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::middleware('guest:web')->group(function () {
    Route::post('/login',[AuthController::class, 'loginHandle'] )->name('loginHandle');
    Route::get('/login',[AuthController::class, 'login'] )->name('login');
    Route::get('/auth/redirect/{provider}', function ($provider) {   
        return Socialite::driver($provider)->redirect();
    })->name('auth.redirect');
     
    Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'] );
});

Route::middleware('auth:web')->group(function () {
    Route::post('/logout',[AuthController::class, 'logOut'] )->name('logOut');
});
// Route::get('/register',[AuthController::class, 'register'] )->name('register');
// Route::post('/register',[AuthController::class, 'registering'] )->name('registering');



// Route::get('/test', [TestController::class, 'index'])->name('test');

Route::get('/',[HomeController::class, 'index'] )->name('index');
