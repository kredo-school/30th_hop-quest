<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit');

