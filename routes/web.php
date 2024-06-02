<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\HomeController;
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
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('product/detail/{slug}', [ControllersProductController::class, 'show'])->name('product.detail');

    Route::post('getVariants', [ControllersProductController::class, 'getVariantByColor'])->name('getVariants');
});
