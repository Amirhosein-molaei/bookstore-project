<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ShopController;
use App\Http\Controllers\Home\FavoritController;
use App\Http\Controllers\Home\ProducttController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\TagController;
use App\Http\Controllers\Admin\Content\BlogController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Market\CopanController;
use App\Http\Controllers\Admin\Content\SlideController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Content\WriterController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Content\PublisherController;
use App\Http\Controllers\Admin\Ticket\TicketFileController;
use App\Http\Controllers\Admin\Market\ProductFileController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Market\ProductCategoryController;
use App\Http\Controllers\Home\HomeFaqController;

// Route::get('/', function () {
//     return view('app.home');
// });


Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', DashboardController::class);

    Route::middleware(['auth','superAdmin'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('user.');
    Route::post('/user/admin-access/{user}', [UserController::class, 'changeAdminAccess'])->name('user.admin-access');
    Route::post('/user/super-admin-access/{user}', [UserController::class, 'changeSuperAdminAccess'])->name('user.super-admin-access');
    Route::post('/user/change-ticket-admin/{user}', [UserController::class, 'changeTicketAdmin'])->name('user.change-ticket-admin');

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::get('set', [SettingController::class, 'set'])->name('set');
        Route::post('/set/store', [SettingController::class, 'setStore'])->name('set.store');
    });
});

    Route::prefix('content')->name('content.')->group(function () {
        Route::resource('menu', MenuController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('writer', WriterController::class);
        Route::resource('writer', WriterController::class);
        Route::resource('tag', TagController::class);
        Route::resource('publisher', PublisherController::class);
        Route::resource('slide', SlideController::class);
        Route::resource('comment', CommentController::class);
        // for change comment status
        Route::put('/comment/{comment}/change-status', [CommentController::class, 'changeStatus'])->name('comment.change-status');

        Route::resource('tags', TagController::class);
        Route::resource('blog', BlogController::class);
        //   banners
        Route::resource('/banners',\App\Http\Controllers\Admin\Content\BannerController::class);
        Route::post('banners/{banner}/select', [\App\Http\Controllers\Admin\Content\BannerController::class, 'select'])->name('banners.select');
    });



    Route::prefix('market')->name('market.')->group(function () {
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('payment', PaymentController::class);
        Route::resource('copan', CopanController::class);
        Route::resource('product', ProductController::class);
        Route::get('product-file/{product}', [ProductFileController::class, 'index'])->name('product-file.index');
        Route::get('product-file/{product}/create', [ProductFileController::class, 'create'])->name('product-file.create');
        Route::post('product-file/{product}', [ProductFileController::class, 'store'])->name('product-file.store');
        Route::get('product-file/{product}/{productFile}/edit', [ProductFileController::class, 'edit'])->name('product-file.edit');
        Route::put('product-file/{product}/{productFile}', [ProductFileController::class, 'update'])->name('product-file.update');
        Route::delete('product-file/{product}/{productFile}', [ProductFileController::class, 'destroy'])->name('product-file.destroy');
        Route::post('product-file/{productFile}/download', [ProductFileController::class, 'download'])->name('product-file.download');
    });

    Route::prefix('ticket')->name('ticket.')->group(function () {
        Route::resource('ticket-category',TicketCategoryController::class);
        Route::resource('ticket-file', TicketFileController::class);
        Route::resource('ticket', TicketController::class);
        Route::post('/change-status/{ticket}', [TicketController::class, 'changeStatus'])->name('ticket.change-status');
        Route::get('ticket-file/download/{ticketFile}', [TicketFileController::class, 'download'])->name('ticket-file.download');
    });


});


// Home
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/product/{product}', [HomeController::class, 'show'])->name('product');
Route::post('/product/favorit/{product}',[FavoritController::class, 'addProduct'])->name('product.favorit');
Route::post('product/comment/{product}',[HomeController::class,'sendComment'])->name('product.comment');
Route::post('product/comment/like/{comment}',[HomeController::class,'likeComment'])->name('product.comment.like');
Route::post('product/comment/dislike/{comment}',[HomeController::class,'dislikeComment'])->name('product.comment.dislike');
Route::post('/product/comment/{product}/answer', [HomeController::class, 'answerComment'])->name('product.comment.answer');

// Cart
Route::middleware('auth')->group(function(){
 Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
});

// shop
Route::get(uri: '/shop', action: [ShopController::class, 'index'])->name('shop');

// Faq
Route::get(uri: '/faq', action: [HomeFaqController::class, 'index'])->name('faq');
