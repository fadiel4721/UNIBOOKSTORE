<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengadaanController;

// Halaman Utama (Daftar Buku) dengan Pencarian
Route::get('/', [BukuController::class, 'index'])->name('home');

// Halaman Admin untuk Mengelola Buku dan Penerbit
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update'); // Menggunakan PUT
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Menggunakan DELETE

// Halaman Pengadaan Buku (Buku dengan Stok Sedikit)
Route::get('/pengadaan', [PengadaanController::class, 'index'])
     ->name('pengadaan.index');

Route::post('/pengadaan/generate-po', [PengadaanController::class, 'generatePo'])
     ->name('pengadaan.generatePo');
