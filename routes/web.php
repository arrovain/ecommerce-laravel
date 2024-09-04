<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'auth'])->name('admin.auth');

    
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/photo/create', [PhotoController::class,'create'])->name('admin.photos.create');
    Route::post('admin/photo/store', [PhotoController::class,'store'])->name('admin.photos.store');
    Route::get('admin/{photo}/edit', [PhotoController::class,'edit'])->name('admin.photos.edit');