<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeginnerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
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
        Route::post('/register', [AuthController::class, 'addUser'])->name('auth.addUser');
    }
);
// Auth
Route::middleware('auth')->group(
    function () {
        // admin
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        // Simulasi
        Route::get('/simulasi', [HomeController::class, 'simulasi'])->name('home.simulasi');
        // Beginner 
        Route::get('/exam/{id}', [ExamController::class, 'index'])->name('exam.index');
        Route::get('/exam-start/{id}', [ExamController::class, 'start'])->name('exam.start');
        Route::get('/exam-continue/{id}', [ExamController::class, 'continue'])->name('exam.continue');
        Route::get('/examintaion/{user_exam_id}', [ExamController::class, 'exam'])->name('exam.exam');
        // setiap klik next/submit
        Route::post('/exam/submit', [ExamController::class, 'submit'])->name('exam.submit');
        // setelah submit
        Route::get('/exam/result', [ExamController::class, 'result'])->name('exam.result');
    }
);

// Redirect
// Route::get('{any}', [HomeController::class, 'index'])->name('index');