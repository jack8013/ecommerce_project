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

// Home Product
route::get('product_details/{id}', [ProductController::class, 'product_details'])->name('product_details');

Route::middleware('auth', 'admin')->prefix('admin')->name('admin.')->group(function () {

    // Admin Category
    route::get('view_category', [AdminController::class, 'view_category'])->name('view_category');
    route::post('add_category', [AdminController::class, 'add_category'])->name('add_category');
    route::delete('delete_category/{id}', [AdminController::class, 'delete_category'])->name('delete_category');
    route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->name('edit_category');
    route::post('update_category/{id}', [AdminController::class, 'update_category'])->name('update_category');



    // Admin Product
    route::get('add_product', [ProductController::class, 'add_product'])->name('add_product');
    route::post('upload_product', [ProductController::class, 'upload_product'])->name('upload_product');
    route::get('view_product', [ProductController::class, 'view_product'])->name('view_product');
    route::delete('delete_product/{id}', [ProductController::class, 'delete_product'])->name('delete_product');
    route::get('edit_product/{id}', [ProductController::class, 'edit_product'])->name('edit_product');
    route::post('update_product/{id}', [ProductController::class, 'update_product'])->name('update_product');
    route::get('search_product', [ProductController::class, 'search_product'])->name('search_product');


    //Admin Order
    route::get('view_order', [AdminController::class, 'view_order'])->name('view_order');
    route::post('on_the_way/{id}', [AdminController::class, 'on_the_way'])->name('on_the_way');
    route::post('delivered/{id}', [AdminController::class, 'delivered'])->name('delivered');
    route::post('print_pdf/{id}', [AdminController::class, 'print_pdf'])->name('print_pdf');
});




Route::middleware('auth', 'verified')->group(function () {
    // Cart
    route::post('add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
    route::get('user_cart', [HomeController::class, 'user_cart'])->name('user_cart');
    route::delete('remove_cart_item/{id}', [HomeController::class, 'remove_cart_item'])->name('remove_cart_item');

    // Order
    route::post('place_order', [HomeController::class, 'place_order'])->name('place_order');
    route::get('get_order', [HomeController::class, 'get_order'])->name('get_order');
});
