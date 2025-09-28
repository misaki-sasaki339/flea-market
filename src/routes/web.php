<?php

use Illuminate\Support\Facades\Route;

//認証関連
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

//コントローラー
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
//
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


//非会員用ページ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');

//会員登録・ログイン用ページ
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

//認証後ページ
//Route::middleware('auth')->group(function (){
//マイページ関連
Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage');
Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('mypage.edit');
Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('mypage.update');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//購入関連
Route::get('/purchase/{item_id}',[OrderController::class, 'index'])->name('purchase');
Route::post('/purchase/{item_id}',[OrderController::class, 'store'])->name('purchase.store');
Route::get('/purchase/address/{item_id}', [OrderController::class, 'editAddress'])->name('purchase.address.edit');
Route::put('/purchase/address/{item_id}', [OrderController::class, 'updateAddress'])->name('purchase.address.update');

//出品関連
Route::get('/sell', [SellController::class, 'create'])->name('sell.create');
Route::post('/sell', [SellController::class, 'store'])->name('sell.store');




