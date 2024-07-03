<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\ProductController as ControllersProductController;


Route::get('admin/login', [IndexController::class, 'login'])->name('admin.login');
Route::post('admin/login', [IndexController::class, 'check_login']);
Route::get('admin/register', [IndexController::class, 'register'])->name('admin.register');
Route::post('admin/register', [IndexController::class, 'check_register']);


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('logout', [IndexController::class, 'logout'])->name('admin.logout');
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');

    Route::resources([
        'category' => CategoryController::class,
        'product' => ProductController::class,
    ]);
});

Route::group(['prefix' => ''], function () {
    // login
    Route::get('login', [CustomerController::class, 'login'])->name('login');
    Route::post('login', [CustomerController::class, 'check_login']);

    // register
    Route::get('register', [CustomerController::class, 'register'])->name('register');
    Route::post('register', [CustomerController::class, 'check_register']);

    // logout
    Route::get('logout', [CustomerController::class, 'logout'])->name('logout');

    // verify-account
    Route::get('verify-account/{email}', [CustomerController::class, 'verifyAccount'])->name('verify-account');

    // home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // danh mục
    Route::get('danh-muc/{slug}', [ControllersCategoryController::class, 'categories'])->name('categories');

    Route::get('product/detail/{slug}', [ControllersProductController::class, 'show'])->name('product.detail');

    Route::post('getVariants', [ControllersProductController::class, 'getVariantByColor'])->name('getVariants');

    Route::get('check-availability', [HomeController::class, 'checkAvailability']);

    // add-to-cart
    Route::post('add-to-cart', [CartController::class, 'store'])->name('add-to-cart');

    //remove-cart-item
    Route::post('remove-cart-item', [CartController::class, 'destroy'])->name('remove-cart-item');

    // view-cart
    Route::get('view-cart', [CartController::class, 'index'])->name('view-cart');

    // update-cart
    Route::post('update-cart', [CartController::class, 'update'])->name('update-cart');

    // products
    Route::get('products', [ControllersProductController::class, 'products'])->name('products');

    // search
    Route::get('search', [ControllersProductController::class, 'search'])->name('search');

    // show-checkout
    Route::get('checkout', [OrderController::class, 'create'])->name('checkout')->middleware('checkLogin');

    // place-order
    Route::post('place-order', [CartController::class, 'store'])->name('place-order');
});
