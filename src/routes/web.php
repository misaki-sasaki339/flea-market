<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

// 非会員用ページ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/item/{item}', [HomeController::class, 'show'])->name('item.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// 会員登録・ログイン用ページ
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// メール認証
// メール確認の通知
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 認証チェック
Route::get('/verification/check', function (Request $request) {
    $user = Auth::user();

    if ($user && $user->hasVerifiedEmail()) {
        return redirect()->route('verification.success');
    }

    return back()->with('message', 'まだ認証が完了していません。メール内のリンクをクリックしてください。');
})->middleware('auth')->name('verification.check');

// メール認証の完了
Route::get('/verification/success', function () {
    return view('auth.verification-success');
})->middleware(['auth', 'verified'])->name('verification.success');

// メール確認のハンドラ
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('verification.success');
})->middleware(['auth', 'signed'])->name('verification.verify');

// メール確認の再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// 認証後ページ
Route::middleware('auth')->group(function () {
    // マイページ関連
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/profile/temp-upload', [ProfileController::class, 'tempUpload'])->name('mypage.tempUpload');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('mypage.update');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // 購入関連
    Route::get('/purchase/address', [PurchaseController::class, 'editAddress'])->name('purchase.address.edit');
    Route::patch('/purchase/address', [PurchaseController::class, 'updateAddress'])->name('purchase.address.update');
    Route::get('/purchase/{item}', [PurchaseController::class, 'create'])->name('purchase');
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/checkout/{order}', [StripeController::class, 'checkout'])->name('payment.checkout');
    Route::get('/success', [StripeController::class, 'success'])->name('payment.success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('payment.cancel');

    // 出品関連
    Route::get('/sell', [SellController::class, 'create'])->name('sell.create');
    Route::post('/sell/temp-upload', [SellController::class, 'tempUpload'])->name('sell.tempUpload');
    Route::post('/sell', [SellController::class, 'store'])->name('sell.store');

    // いいね機能
    Route::post('/item/favorite/{id}', [FavoriteController::class, 'favorite'])->name('item.favorite');
    Route::post('/item/unfavorite/{id}', [FavoriteController::class, 'unfavorite'])->name('item.unfavorite');

    // コメント機能
    Route::post('/item/comment/{item_id}', [CommentController::class, 'store'])->name('item.comment');

    // チャット機能
    Route::get('/messages/{order}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/draft', [MessageController::class, 'saveDraft'])->name('messages.draft');
    Route::post('/messages/{order}', [MessageController::class, 'store'])->name('messages.store');
    Route::patch('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // レビュー機能
    Route::post('/reviews/{order}', [ReviewController::class, 'store'])->name('reviews.store');
});


// メールビューの確認用ルート
/* use App\Mail\TransactionCompletedMail;
use App\Models\Order;

Route::get('/mail/preview/transaction/{order}', function (Order $order) {
    return new TransactionCompletedMail($order);
}); */
