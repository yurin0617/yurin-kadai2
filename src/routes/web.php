<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

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



// 商品登録画面を表示する（GET）
Route::get('/products/register', [ProductController::class, 'create'])->name('product.register');

// 商品を保存する処理（POST）
Route::post('/products/register', [ProductController::class, 'store'])->name('product.store');


// 商品詳細 兼 編集画面を表示する (GET)
Route::get('/products/detail/{productId}', [ProductController::class, 'show'])->name('products.show');
// 商品を更新保存する処理 (POST)
Route::post('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');
// 商品を削除する処理 (POST)
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

Route::middleware('auth')->group(
    function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    }
);


