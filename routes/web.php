<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FabrictypeController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\OrdersController as StoreOrdersController; ;

use App\Http\Controllers\CartController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController as StoreProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Orders;


// =============  Front Store =================


    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/product', [StoreProductController::class, 'index'])->name('product');
    Route::get('/product/{product:slug}', [StoreProductController::class, 'show'])->name('product.show');


// ===============  Cart =================


Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'show'])->name('show');              // GET  /cart
    Route::post('/add', [CartController::class, 'add'])->name('add');            // POST /cart/add
    Route::patch('/update', [CartController::class, 'update'])->name('update');  // PATCH /cart/update
    Route::delete('/remove', [CartController::class, 'remove'])->name('remove'); // DELETE /cart/remove
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');    // DELETE /cart/clear
});
Route::post('/prossesCart', [CartController::class, 'prossesCart'])->name('prossesCart');
Route::get('shopingcart', [CartController::class, 'shopingcart'])->name('shopingcart');
Route::patch('/cart/governorate', [CartController::class, 'setGovernorate'])->name('cart.governorate');
// Route::get('sucess_order', [CartController::class, 'sucess_order'])->name('sucess_order');

// Route::get('sucess_order', function () {

//     if (!session()->has('can_view_success')) {
//         abort(404);
//     }

//     $order = Orders::findOrFail(session('success_order_id'));

//     session()->forget(['can_view_success', 'success_order_id']);

//     return view('store.successOrder', compact('order'));
// })->name('sucess_order');


Route::get('sucess_order', [StoreOrdersController::class, 'success'])
    ->name('sucess_order');


// =============== Addmin Routes =================

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::controller(CategoryController::class)->middleware('auth')->prefix('admin')->group(function(){
    Route::get('/Categorylist', 'index')->name('Categorylist');
    Route::post('/add_Category', 'create')->name('add_Category');
});

Route::controller(ProductController::class)->middleware('auth')->prefix('admin')->group(function(){
    Route::get('/productList', 'index')->name('productList');
    Route::post('/add_product', 'create')->name('add_product');
    Route::post('/edit_product/{productId}', 'edit_product')->name('edit_product');
    Route::post('/destroy/{productId}', 'destroy')->name('destroy');
});

Route::controller(VisitorController::class)->middleware('auth')->prefix('admin')->group(function(){
    Route::get('/visitorsList', 'index')->name('visitorsList');
});

Route::controller(SettingController::class)->middleware('auth')->prefix('admin')->group(function(){
    Route::get('/setting', 'index')->name('setting');

});

Route::controller(FabricTypeController::class)->middleware('auth')->prefix('admin')->group(function(){
    Route::get('/fabricList', 'index')->name('fabricList');
    Route::post('/add_fabric', 'create')->name('add_fabric');

});

Route::controller(OrdersController::class)->middleware('auth')->prefix('admin')->group(function(){
    Route::get('Orders', 'index')->name('Orders');
    Route::post('Send_whatsapp', 'Send_whatsapp')->name('Send_whatsapp');

});



require __DIR__.'/auth.php';
