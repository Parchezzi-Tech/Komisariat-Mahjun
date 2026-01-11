<?php

use Illuminate\Support\Facades\Route; 
use Inertia\Inertia;
use App\Http\Controllers\AnggotaImportController;
use App\Http\Controllers\SuratPdfController;

// Homepage & Dashboard langsung ke Welcome.vue (bersih total)
Route::inertia('/', 'Welcome')->name('home');
Route::inertia('/dashboard', 'Dashboard/User')->middleware(['auth', 'verified'])->name('dashboard');
Route::inertia('/dashboard/admin', 'Dashboard/Admin')->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

// Anggota Import/Export routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/anggota/template', [AnggotaImportController::class, 'downloadTemplate'])->name('anggota.template');
    Route::post('/anggota/import', [AnggotaImportController::class, 'import'])->name('anggota.import');
});

// Surat PDF Generation
Route::middleware(['auth'])->group(function () {
    Route::get('/surat/{surat}/pdf', [SuratPdfController::class, 'generate'])->name('surat.pdf');
});

// Auth routes Breeze (tetap ada biar bisa login/register kalau butuh nanti)
require __DIR__.'/auth.php';