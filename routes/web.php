<?php

use App\Http\Controllers\Home\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ShopController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CheckoutController;
use App\Http\Controllers\Home\FavoriteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\TagController;
use App\Http\Controllers\Admin\Content\BlogController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Market\CopanController;
use App\Http\Controllers\Admin\Content\SlideController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Content\BannerController;
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
        Route::resource('/banners',BannerController::class);
        Route::post('banners/{banner}/select', [BannerController::class, 'select'])->name('banners.select');
    });



    Route::prefix('market')->name('market.')->group(function () {
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('payment', PaymentController::class);
        Route::resource('copan', CopanController::class);
        Route::resource('product', ProductController::class);
        Route::post('/product/change-hot-deal-status/{product}', [ProductController::class, 'changeHotDealStatus'])->name('product.change-hot-deal-status');
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
Route::get('/',[HomeController::class,'index'])->name('app.home');
Route::get('/product/{product}', [HomeProductController::class, 'show'])->name('product');

Route::get('/blogs', [\App\Http\Controllers\Home\BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [\App\Http\Controllers\Home\BlogController::class, 'show'])->name('blogs.show');
Route::get('/writers', [\App\Http\Controllers\Home\WriterController::class, 'index'])->name('writers.index');
Route::get('/writers/{id}/details', function($id) {
    $writer = \App\Models\Content\Writer::findOrFail($id);

    return response()->json([
        'name' => $writer->name,
        'english_name' => $writer->english_name,
        'nationality' => $writer->nationality,
        'birth_year' => $writer->birth_year,
        'death_year' => $writer->death_year,
        'description' => $writer->description,

    ]);
});

Route::middleware('auth')->group(function(){
  
  //cart
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
    Route::get('/cart/empty', [CartController::class, 'emptyCart'])->name('cart.empty');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout/apply-discount', [CheckoutController::class, 'applyDiscount'])->name('checkout.apply-discount');
    Route::post('/checkout/remove-discount', [CheckoutController::class, 'removeDiscount'])->name('checkout.remove-discount');
    Route::post('/checkout/submit', [CheckoutController::class, 'submit'])->name('checkout.submit');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/fail', [CheckoutController::class, 'fail'])->name('checkout.fail');
    
    // add to favorite and comment
    Route::post('product/favorite/{product}',[FavoriteController::class, 'addProduct'])->name('product.favorite'); 
    Route::post('product/comment/{product}',[HomeProductController::class,'sendComment'])->name('product.comment');
    Route::post('product/comment/{product}/answer', [HomeProductController::class, 'answerComment'])->name('product.comment.answer');
    Route::post('product/comment/like/{comment}',[HomeProductController::class,'likeComment'])->name('product.comment.like');
    Route::post('product/comment/dislike/{comment}',[HomeProductController::class,'dislikeComment'])->name('product.comment.dislike');
});

// shop
Route::get(uri: '/shop/{categorySlug?}', action: [ShopController::class, 'index'])->name('shop');
Route::get(uri: '/shop/available-product', action: [ShopController::class, 'availableProduct'])->name('shop.available-product');
Route::get(uri: '/shop/with-picture-product', action: [ShopController::class, 'withPictureProduct'])->name('shop.with-picture-product');
Route::get(uri: '/shop/most-expensive-product', action: [ShopController::class, 'mostExpensiveProduct'])->name('shop.most-expensive-product');
Route::get(uri: '/shop/cheapest-product', action: [ShopController::class, 'cheapestProduct'])->name('shop.cheapest-product');

// Faq
Route::get(uri: '/faq', action: [HomeFaqController::class, 'index'])->name('faq');

// profile
Route::prefix('user-profile')->name('user-profile.')->middleware('auth')->group(function(){
    Route::get('/', [UserProfileController::class, 'index']);
    Route::get('/ticket', [UserProfileController::class, 'showTicket'])->name('ticket');

});
