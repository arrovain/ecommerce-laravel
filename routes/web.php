<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', [AdminController::class, 'index']->name('admin.index');
    

