<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Http;
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




// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(AuthController::class)->group(function() {
    Route::get('/', 'index');
    Route::post('/login', 'login')->name('login');
    Route::get('/register', 'register');
    Route::post('/signup', 'signup')->name('register');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('home');
    Route::post('/input', 'input')->name('input');
    Route::delete('/delete/{id}', 'delete')->name('delete');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
});