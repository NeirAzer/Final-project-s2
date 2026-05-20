<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

// Guest Route (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Auth Route (Sudah Login)
Route::middleware('auth')->group(function () {
    // Dashboard (Beranda)
    Route::get('/dashboard', function () {
        $notes = auth()->user()->notes()->with('folder')->latest()->get();
        $foldersCount = auth()->user()->folders()->count();
        return view('dashboard.index', compact('notes', 'foldersCount'));
    })->name('dashboard');

    // Catatan
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit'); // Rute Form Edit
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update'); // Rute Simpan Edit
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy'); // Rute Hapus Catatan

    // Folder
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');
    Route::get('/folders/{folder}', [FolderController::class, 'show'])->name('folders.show');
    Route::put('/folders/{folder}', [FolderController::class, 'update'])->name('folders.update'); // Rute Edit Nama Folder
    Route::delete('/folders/{folder}', [FolderController::class, 'destroy'])->name('folders.destroy');

    // Akun Saya
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account/profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
    Route::post('/account/password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
    Route::delete('/account/sessions/{id}', [AccountController::class, 'logoutSession'])->name('account.logoutSession');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});