<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DiskusiController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\MentoringController;
use App\Http\Controllers\Pengguna\DiskusiPenggunaController;
use App\Http\Controllers\Pengguna\ForumPenggunaController;
use App\Http\Controllers\Pengguna\MentoringPenggunaController;
use App\Http\Controllers\Pengguna\PenggunaDashboardController;
use App\Http\Controllers\Pengguna\ProfileController;

Route::get('/', function () {
    return view('landing_page');
})->name('landing_page');


// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rute Pengguna (Mahasiswa dan Mentor)
Route::middleware(['auth', 'rolemanager:user'])->prefix('pengguna')->group(function () {
    // Profile
    Route::get('/pengguna/profile', [ProfileController::class, 'profile'])->name('pengguna.profile');
    Route::post('/pengguna/profile/update', [ProfileController::class, 'updateProfile'])->name('pengguna.profile.update');
    Route::put('/pengguna/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Forum
    Route::get('forum', [ForumPenggunaController::class, 'index'])->name('pengguna.forum');
    Route::post('forum', [ForumPenggunaController::class, 'store'])->name('pengguna.forum.store');
    Route::put('forum/update/{forum}', [ForumPenggunaController::class, 'update'])->name('forum.update');
    Route::delete('forum/destroy/{forum}', [ForumPenggunaController::class, 'destroy'])->name('pengguna.forum.destroy');
    Route::post('/forum/{forumId}/favorit', [ForumPenggunaController::class, 'favorit'])->name('forum.favorit');
    
    
    // Diskusi
    Route::get('diskusi', [DiskusiPenggunaController::class, 'index'])->name('pengguna.diskusi');
    Route::post('diskusi', [DiskusiPenggunaController::class, 'store'])->name('pengguna.diskusi.store');
    Route::put('diskusi/update/{diskusi}', [DiskusiPenggunaController::class, 'update'])->name('diskusi.update');
    Route::delete('diskusi/destroy/{diskusi}', [DiskusiPenggunaController::class, 'destroy'])->name('pengguna.diskusi.destroy');
    Route::post('/diskusi/{diskusiId}/favorit', [DiskusiPenggunaController::class, 'favorit'])->name('diskusi.favorit');
    
    
    
    // Mentoring
    Route::get('mentoring', [MentoringPenggunaController::class, 'index'])->name('pengguna.mentoring');
    Route::post('mentoring', [MentoringPenggunaController::class, 'store'])->name('pengguna.mentoring.store');
    Route::put('mentoring/update/{mentoring}', [MentoringPenggunaController::class, 'update'])->name('mentoring.update');
    Route::delete('mentoring/destroy/{mentoring}', [MentoringPenggunaController::class, 'destroy'])->name('pengguna.mentoring.destroy');
    Route::post('/mentoring/{mentoringId}/favorit', [MentoringPenggunaController::class, 'favorit'])->name('mentoring.favorit');
});
