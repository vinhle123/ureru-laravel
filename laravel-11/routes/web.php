<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyCustomToken;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/form', [UserController::class, 'showForm']);
//Route::post('/user/submit', [UserController::class, 'submitForm'])->name('user.submit');
Route::middleware([VerifyCustomToken::class])->post('/user/submit', [UserController::class, 'submitForm'])->name('user.submit');
