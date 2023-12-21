
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'list'])->name('users.list');
