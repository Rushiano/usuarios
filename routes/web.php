<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/show', [UserController::class, 'show'])->name('users.show');
