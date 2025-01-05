<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home.index');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');


// Admin Category
route::get('admin/view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin'])->name('admin.view_category');
route::post('admin/add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin'])->name('admin.add_category');
route::delete('admin/delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth', 'admin'])->name('admin.delete_category');
route::get('admin/edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth', 'admin'])->name('admin.edit_category');
route::post('admin/update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin'])->name('admin.update_category');

// Admin Product
route::get('admin/add_product', [ProductController::class, 'add_product'])->middleware(['auth', 'admin'])->name('admin.add_product');
route::post('admin/upload_product', [ProductController::class, 'upload_product'])->middleware(['auth', 'admin'])->name('admin.upload_product');
route::get('admin/view_product', [ProductController::class, 'view_product'])->middleware(['auth', 'admin'])->name('admin.view_product');
route::delete('admin/delete_product/{id}', [ProductController::class, 'delete_product'])->middleware(['auth', 'admin'])->name('admin.delete_product');
route::get('admin/edit_product/{id}', [ProductController::class, 'edit_product'])->middleware(['auth', 'admin'])->name('admin.edit_product');
route::post('admin/update_product/{id}', [ProductController::class, 'update_product'])->middleware(['auth', 'admin'])->name('admin.update_product');
route::get('admin/search_product', [ProductController::class, 'search_product'])->middleware(['auth', 'admin'])->name('admin.search_product');

//Admin Order
route::get('admin/view_order', [AdminController::class, 'view_order'])->middleware(['auth', 'admin'])->name('admin.view_order');
route::post('admin/on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin'])->name('admin.on_the_way');
route::post('admin/delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin'])->name('admin.delivered');
route::post('admin/print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware(['auth', 'admin'])->name('admin.print_pdf');

// Home Product
route::get('product_details/{id}', [ProductController::class, 'product_details'])->name('product_details');

// Cart
route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart')->middleware('auth', 'verified');
route::get('user_cart', [HomeController::class, 'user_cart'])->name('user_cart')->middleware('auth', 'verified');
route::delete('remove_cart_item/{id}', [HomeController::class, 'remove_cart_item'])->name('remove_cart_item')->middleware('auth', 'verified');

// Order
route::post('place_order', [HomeController::class, 'place_order'])->name('place_order')->middleware('auth', 'verified');
route::get('get_order', [HomeController::class, 'get_order'])->name('get_order')->middleware('auth', 'verified');
