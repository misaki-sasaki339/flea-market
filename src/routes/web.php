<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

//認証関連
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

//コントローラー
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StripeController;

use Illuminate\Support\Facades\Mail;
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
Route::get('/item/{item}', [HomeController::class, 'show'])->name('item.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');

//会員登録・ログイン用ページ
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
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
Route::get('/purchase/address', [PurchaseController::class, 'editAddress'])->name('purchase.address.edit');
Route::patch('/purchase/address', [PurchaseController::class, 'updateAddress'])->name('purchase.address.update');
Route::get('/purchase/{item}',[PurchaseController::class, 'create'])->name('purchase');
Route::post('/purchase/{item}',[PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/checkout/{order}',[StripeController::class, 'checkout'])->name('payment.checkout');
Route::get('/success', [StripeController::class, 'success'])->name('payment.success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('payment.cancel');

//出品関連
Route::get('/sell', [SellController::class, 'create'])->name('sell.create');
Route::post('/sell', [SellController::class, 'store'])->name('sell.store');

//いいね機能
Route::get('/item/favorite/{id}', [FavoriteController::class, 'favorite'])->name('item.favorite');
Route::get('/item/unfavorite/{id}', [FavoriteController::class, 'unfavorite'])->name('item.unfavorite');

//コメント機能
Route::post('/item/comment/{id}', [CommentController::class, 'store'])->middleware('auth')->name('item.comment');

//mailhog
Route::get('/mail-test', function () {
    Mail::raw('テストメールです！', function ($message) {
        $message->to('test@example.com')->subject('MailHogテスト');
    });
    return 'メール送信完了！';
});
