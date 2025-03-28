<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\LinkController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [LoginController::class, 'register']);


Route::get('/', action: [ShortLinkController::class, 'index']);


Route::middleware(['auth'])->group(function () {
    Route::get('/check-expired-links', [LinkController::class, 'checkExpiredLinks']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/shorten', action: [ShortLinkController::class, 'store']);
    Route::get('/success', action: [ShortLinkController::class, 'success'])->name('success');
    Route::get('/short/{code}', action: [ShortLinkController::class, 'redirect']);
    
    Route::get(uri: '/links', action: [ShortLinkController::class, 'showLinks'])->name('links.index');
    Route::get('/links/{id}/edit', action: [ShortLinkController::class, 'edit'])->name('links.edit');
    Route::put('/links/{id}', action: [ShortLinkController::class, 'update'])->name('links.update');
    Route::delete('/links/{id}', action: [ShortLinkController::class, 'destroy'])->name('links.destroy');
    Route::post('/toggle-status/{id}', action: [ShortLinkController::class, 'toggleStatus'])->name('links.toggleStutas');
});
