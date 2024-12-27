<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home.index');
// });

Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin'])->name('admin.dashboard');


// Category
route::get('admin/view_category',[AdminController::class, 'view_category'])->middleware(['auth','admin'])->name('admin.view_category');
route::post('admin/add_category',[AdminController::class, 'add_category'])->middleware(['auth','admin'])->name('admin.add_category');
route::delete('admin/delete_category/{id}',[AdminController::class,'delete_category'])->middleware(['auth','admin'])->name('admin.delete_category');
route::get('admin/edit_category/{id}',[AdminController::class,'edit_category'])->middleware(['auth','admin'])->name('admin.edit_category');
route::post('admin/update_category/{id}',[AdminController::class,'update_category'])->middleware(['auth','admin'])->name('admin.update_category');

// Product
route::get('admin/add_product',[ProductController::class,'add_product'])->middleware(['auth','admin'])->name('admin.add_product');
route::post('admin/upload_product',[ProductController::class,'upload_product'])->middleware(['auth','admin'])->name('admin.upload_product');
route::get('admin/view_product',[ProductController::class,'view_product'])->middleware(['auth','admin'])->name('admin.view_product');