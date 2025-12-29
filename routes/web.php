<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FabrictypeController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController as StoreProductController;
use Illuminate\Support\Facades\Route;

    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/product', [StoreProductController::class, 'index'])->name('product');
    Route::get('/product/{product:slug}', [StoreProductController::class, 'show'])->name('product.show');


Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'show'])->name('show');              // GET  /cart
    Route::post('/add', [CartController::class, 'add'])->name('add');            // POST /cart/add
    Route::patch('/update', [CartController::class, 'update'])->name('update');  // PATCH /cart/update
    Route::delete('/remove', [CartController::class, 'remove'])->name('remove'); // DELETE /cart/remove
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');    // DELETE /cart/clear
});
Route::post('/prossesCart', [CartController::class, 'prossesCart'])->name('prossesCart');    // DELETE /cart/clear
Route::get('shopingcart', [CartController::class, 'shopingcart'])->name('shopingcart');

// Addmin Routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::controller(ProductController::class)->middleware('auth')->group(function(){
    Route::get('/productList', 'index')->name('productList');
    Route::post('/add_product', 'create')->name('add_product');
    Route::post('/edit_product/{productId}', 'edit_product')->name('edit_product');
    Route::post('/destroy/{productId}', 'destroy')->name('destroy');
});


Route::controller(CategoryController::class)->middleware('auth')->group(function(){
    Route::get('/Categorylist', 'index')->name('Categorylist');
    Route::post('/add_Category', 'create')->name('add_Category');
});

Route::controller(VisitorController::class)->middleware('auth')->group(function(){
    Route::get('/visitorsList', 'index')->name('visitorsList');

});

Route::controller(SettingController::class)->middleware('auth')->group(function(){
    Route::get('/setting', 'index')->name('setting');

});

Route::controller(FabricTypeController::class)->middleware('auth')->group(function(){
    Route::get('/fabricList', 'index')->name('fabricList');
    Route::post('/add_fabric', 'create')->name('add_fabric');

});

// Route::middleware('count.visits')->group(function () {
//     Route::get('/', fn () => view('store.index'));
//     // Route::get('/products', fn () => view('products'));
// });

require __DIR__.'/auth.php';
