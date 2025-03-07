<?php

use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Market\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PublisherController;
use App\Http\Controllers\Admin\Content\WriterController;
use App\Http\Controllers\Admin\Market\CopanController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Market\ProductCategoryController;
use App\Http\Controllers\Admin\Content\TagController;
use App\Http\Controllers\Admin\User\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/',DashboardController::class);

    Route::get('/users', [UserController::class, 'index'])->name('user.');
    Route::post('/user/change-access/{user}', [UserController::class, 'changeAccess'])->name('user.change-access');
    Route::post('/user/change-ticket-admin/{user}', [UserController::class, 'changeTicketAdmin'])->name('user.change-ticket-admin');

    Route::prefix('content')->name('content.')->group(function () {
        Route::resource('menu', MenuController::class);
        Route::resource('faq', FaqController::class);
        Route::resource('writer', WriterController::class);
        Route::resource('writer', WriterController::class);
        Route::resource('tag', TagController::class);
        Route::resource('publisher', PublisherController::class);
        Route::resource('comment', CommentController::class);
        // for change comment status
        Route::put('/comment/{comment}/change-status', [CommentController::class, 'changeStatus'])->name('comment.change-status');
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/',[SettingController::class,'index']);
        Route::get('set',[SettingController::class,'set'])->name('set');
        Route::post('/set/store', [SettingController::class, 'setStore'])->name('set.store');

    });

    Route::prefix('market')->name('market.')->group(function () {
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('payment', PaymentController::class);
        Route::resource('copan', CopanController::class);
        Route::resource('product', ProductController::class);

    });

});
