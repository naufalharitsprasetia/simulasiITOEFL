<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/faq', [HomeController::class, 'faq'])->name('home.faq');

Route::middleware('guest')->group(
    function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
        Route::get('/register', [AuthController::class, 'register'])->name('register');
    }
);
// Auth
Route::middleware('auth')->group(
    function () {
        // admin
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        // Blog
        // Route::get('/blog-list', [BlogController::class, 'list'])->name('blog.list');
        // Route::get('/blog-create', [BlogController::class, 'create'])->name('blog.create');
        // Route::post('/blog-create', [BlogController::class, 'store'])->name('blog.store');
        // Route::get('/blog-edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
        // Route::put('/blog-edit/{blog}', [BlogController::class, 'update'])->name('blog.update');
        // Route::delete('/blog-delete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
    }
);

// Redirect
Route::get('{any}', [HomeController::class, 'index'])->name('index');