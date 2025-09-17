<?php

use App\Http\Controllers\Auth_Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('products.delete');

// Auth routes
Route::get('/login', [Auth_Controller::class, 'login'])->name('login');
Route::post('/login', [Auth_Controller::class, 'loginUser'])->name('login.user');

Route::get('/register', [Auth_Controller::class, 'register'])->name('register');
Route::post('/register', [Auth_Controller::class, 'registerUser'])->name('register.user');

Route::get('/dashboard', [Auth_Controller::class, 'dashboard'])->name('dashboard'); // ✅ added
Route::get('/logout', [Auth_Controller::class, 'logout'])->name('logout');
