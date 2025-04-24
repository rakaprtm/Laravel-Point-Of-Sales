<?php

use App\Http\Controllers\BelajarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\KasirController;

Route::get('/', function () {
    return view('login');
});

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah']);
Route::get('kurang', [BelajarController::class, 'kurang']);

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin']);

Route::post('actionTambah', [BelajarController::class, 'actionTambah']);
Route::post('actionKurang', [BelajarController::class, 'actionKurang']);

Route::resource('dashboard', DashboardController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('products', ProductController::class);
route::resource('pos', TransactionController::class);
Route::post('/transaction/{id}/payment', [TransactionController::class, 'updatePayment'])->name('pos.updatePayment');


Route::get('get-product/{id}', [TransactionController::class, 'getProduct']);


Route::resource('users', UserController::class);
route::get('logout', [LoginController::class, 'logout']);

route::get('get-product/{id}', [TransactionController::class, 'getProduct']);
Route::get('print/{id}', [TransactionController::class, 'print'])->name('print');



Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
route::post('/kasir',[KasirController::class, 'store'])->name('kasir.store');
