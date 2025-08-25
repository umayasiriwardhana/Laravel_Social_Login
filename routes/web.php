<?php

use App\Models\User;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])->name('google-auth-callback');

Route::middleware('auth')->group(function () {
    Route::get('/calendar', [GoogleController::class, 'calendar'])->name('google.calendar');
    Route::get('/emails', [GoogleController::class, 'emails'])->name('google.emails');
    Route::get('/todos', [GoogleController::class, 'todos'])->name('google.todos');
});

require __DIR__.'/auth.php';
