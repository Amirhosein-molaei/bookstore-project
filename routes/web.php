<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Content\FaqController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Setting\SettingController;

Route::get('/', function () {
    $purchases = Auth::user()->purchases;
    foreach($purchases as $purchase)
    {
        echo $purchase->product->title . '<br/>';
    }
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


Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {

    Route::get('/',DashboardController::class);

    Route::prefix('content')->name('content.')->group(function () {
        Route::resource('menu', MenuController::class);
        Route::resource('faq', FaqController::class);
    });
    
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/',[SettingController::class,'index']);
        Route::get('set',[SettingController::class,'set'])->name('set');
        Route::post('/set/store', [SettingController::class, 'setStore'])->name('set.store');


    });

});
