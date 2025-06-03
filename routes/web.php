<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentLoginController;
use App\Http\Controllers\userLoginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\studentController;

//Middleware agar route tidak bisa diakses jika sudah melakukan Login
Route::middleware(['logged'])->group(function () {
    // Route Login buat guru (user)
    Route::get('/user-login', [userLoginController::class, 'showLogin']);
    Route::post('/user-login', [userLoginController::class, 'login'])->name('user-login');

    // Route Login buat murid
    Route::get('/', [studentLoginController::class, 'showLogin']);
    Route::post('/', [studentLoginController::class, 'login'])->name('student-login');
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
    Route::get('/user/student/{id}/export-pdf', [userController::class, 'exportPDF'])->name('student-detail.pdf');
    Route::get('/search-students', [StudentController::class, 'search'])->name('students.search');
});

// Midlleware agar Route hanya bisa diakses oleh murid yang sudah login
Route::middleware(['auth.student'])->group(function () {
    Route::post('/student-logout', [studentLoginController::class, 'logout'])->name('student-logout');
    Route::get('/student-dashboard', [studentController::class, 'dashboard'])->name('student-dashboard');
    Route::resource('student', studentController::class);
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');

});

Route::middleware(['auth.admin'])->group(function () {
    Route::view('/admin-dashboard', 'admin.dashboard')->name('admin-dashboard');
    //
    Route::get('/admin-user-dashboard', [adminController::class, 'dashboard'])->name('admin-user-dashboard');
    Route::post('/admin-user-dashboard', [adminController::class, 'store'])->name('admin-user-store');
    Route::get('/edit-user/{id}', [adminController::class, 'edit'])->name('admin-user-edit');
    Route::put('/edit-user/{id}', [adminController::class, 'update'])->name('admin-user-update');
    Route::delete('/admin-user-dashboard/{id}', [adminController::class, 'destroy'])->name('admin-user-destroy');
    //
    Route::get('/admin-student-dashboard', [adminController::class, 'student_dashboard'])->name('admin-student-dashboard');
    Route::post('/admin-student-dashboard', [adminController::class, 'student_store'])->name('admin-student-store');
    Route::get('/edit-student/{id}', [adminController::class, 'student_edit'])->name('admin-student-edit');
    Route::put('/edit-student/{id}', [adminController::class, 'student_update'])->name('admin-student-update');
    Route::delete('/admin-student-dashboard/{id}', [adminController::class, 'student_destroy'])->name('admin-student-destroy');

    Route::get('/admin-group-dashboard', [adminController::class, 'group_dashboard'])->name('admin-group-dashboard');
    Route::post('/admin-group-dashboard', [adminController::class, 'group_store'])->name('admin-group-store');
    Route::get('/edit-group/{id}', [adminController::class, 'group_edit'])->name('admin-group-edit');
    Route::put('/edit-group/{id}', [adminController::class, 'group_update'])->name('admin-group-update');
    Route::delete('/admin-group-dashboard/{id}', [adminController::class, 'group_destroy'])->name('admin-group-destroy');

    Route::get('/get-groups-by-guru/{user_id}', [AdminController::class, 'getGroupsByGuru']);

});
