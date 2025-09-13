<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

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

Route::get('/', function () {return view('welcome');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/list' , [App\Http\Controllers\ArticleController::class,'showList'])->name('list');

Route::get('/regist' , [App\Http\Controllers\ArticleController::class,'showRegistForm'])->name('regist');

Route::post('/regist' , [App\Http\Controllers\ArticleController::class,'registSubmit'])->name('submit');

Route::resource('products' , ProductController::class);

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {Route::resource('products', ProductController::class);});

Route::post('login', [LoginController::class, 'login']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('Products.edit');

Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');