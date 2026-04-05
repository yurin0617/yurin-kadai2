<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// 商品詳細画面
Route::get('/products/detail/{productId}', [ProductController::class, 'show'])->name('products.show');
// 商品登録画面を表示する（GET）
Route::get('/products/register', [ProductController::class, 'create'])->name('product.register');

// 商品を保存する処理（POST）
Route::post('/products/register', [ProductController::class, 'store'])->name('product.store');

// 商品編集画面を表示する
Route::get('/products/{productId}/update', [ProductController::class, 'edit'])->name('products.edit');
// 2. 【重要】データを更新保存する（POST）を追加！
Route::post('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

