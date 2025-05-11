<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Pengguna\PenggunaDashboardController;

Route::get('/', function () {
    return view('landing_page');
})->middleware('guest')->name('landing_page');

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rute Admin
Route::middleware(['auth', 'rolemanager:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/pengguna', [AdminUserController::class, 'index'])->name('admin.datapengguna');
    Route::get('/admin/profile', [AdminUserController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminUserController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/admin/profile/password', [AdminUserController::class, 'updatePassword'])->name('password.update');

    // Forum
    Route::get('forums', [ForumController::class, 'index'])->name('admin.forum');
    Route::post('forums', [ForumController::class, 'store'])->name('admin.forum.store');
    Route::put('forums/update/{forum}', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('forums/destroy/{forum}', [ForumController::class, 'destroy'])->name('admin.forum.destroy');
});

// Rute Pengguna (Mahasiswa dan Mentor)
Route::middleware(['auth', 'rolemanager:user'])->prefix('pengguna')->group(function () {
    Route::get('/dashboard', [PenggunaDashboardController::class, 'index'])->name('pengguna.dashboard');
});
