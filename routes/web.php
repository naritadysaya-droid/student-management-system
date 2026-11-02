<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit'); // Added ->name('register.submit')

// Protected Student CRUD Routes (Requires Login)
Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentController::class);
});




Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('departments', DepartmentController::class); // Added department routes
});
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('students/{id}/delete', [StudentController::class, 'confirmDelete'])->name('students.delete');
    Route::resource('students', StudentController::class);
    Route::resource('departments', DepartmentController::class);
});