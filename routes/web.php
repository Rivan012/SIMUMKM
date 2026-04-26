<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Produk\AdminProdukController;
use App\Http\Controllers\Produk\CartController;
use App\Http\Controllers\Produk\KategoriController;
use App\Http\Controllers\Produk\OrderController;
use App\Http\Controllers\Produk\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\SettingController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/web-settings', function () {
        return view('web.config');
    })->name('web-settings');
    Route::resource('/kategori', KategoriController::class)->names('kategori');
    Route::post('/web-settings', [SettingController::class, 'store'])->name('web-settings.post');
    Route::resource('/admin/produk', AdminProdukController::class)->names('produkadmin');

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('/produk', ProdukController::class)->names('produk');
    Route::resource('/order', OrderController::class)->names('order');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{id}', [CartController::class, 'updateQty'])->name('cart.update');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');

    Route::get('riwayat', [OrderController::class, 'riwayat'])->name('riwayat');

});

require __DIR__ . '/auth.php';
