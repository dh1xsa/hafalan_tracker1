<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentLoginController;
use App\Http\Controllers\userLoginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\studentController;

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


//Middleware agar route tidak bisa diakses jika sudah melakukan Login
Route::middleware(['logged'])->group(function () {
    // Route Login buat guru (user)
    Route::get('/user-login', [userLoginController::class, 'showLogin']);
    Route::post('/user-login', [userLoginController::class, 'login'])->name('user-login');

    // Route Login buat murid
    Route::get('/student-login', [studentLoginController::class, 'showLogin']);
    Route::post('/student-login', [studentLoginController::class, 'login'])->name('student-login');
});

// Midlleware agar Route hanya bisa diakses oleh guru(user)
Route::middleware(['auth.user'])->group(function () {
    Route::post('/user-logout', [userLoginController::class, 'logout'])->name('user-logout');
    //dashboard User
    Route::get('/user-dashboard', [userController::class, 'dashboard'])->name('user-dashboard');
    //menambahkan data hafalan
    Route::post('/user-dashboard', [userController::class, 'store'])->name('user-store');
    //melihat data halaman persiswa
    Route::get('/student-detail/{student_id}', [userController::class, 'show'])->name('student-detail');
    //update data hafalan
    Route::get('/edit-hafalan/{id}', [UserController::class, 'edit'])->name('hafalan-edit');
    Route::put('/edit-hafalan/{id}', [UserController::class, 'update'])->name('hafalan-update');
    //menghapus data hafalan siswa
    Route::delete('/student-detail/{id}', [userController::class, 'destroy'])->name('hafalan-destroy');
});

// Midlleware agar Route hanya bisa diakses oleh murid yang sudah login
Route::middleware(['auth.student'])->group(function () {
    Route::post('/student-logout', [studentLoginController::class, 'logout'])->name('student-logout');
    Route::get('/student-dashboard', [studentController::class, 'dashboard'])->name('student-dashboard');
});
