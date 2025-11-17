<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\Api\PurchaseController;

use App\Http\Controllers\Auth\LoginController;

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

// TOP → 商品一覧へリダイレクト
Route::get('/', function () {
    return redirect()->route('products.index');
});

// ログイン機能
Auth::routes();

// ログイン後HOME
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 商品一覧・登録・編集など（ログインが必要）
Route::middleware(['auth'])->group(function () {
    // 商品CRUD
    Route::resource('products', ProductController::class);
    // Ajax検索
    Route::get('/products/search', [ProductController::class, 'search'])
    ->name('products.search');
});

// Ajax 購入API
Route::post('/api/purchase', [PurchaseController::class, 'purchase']);