<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', [DashboardController::class, 'index'])->name("dashboard");

//Category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::post('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

//Product
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');


//test for login
Route::get('/login', function(){
    return view('auth.login');
});

