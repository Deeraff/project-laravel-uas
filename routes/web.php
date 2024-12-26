<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

// Rute utama
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/products', AdminController::class);
});

// Rute untuk login dan logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

// Rute untuk halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
// Rute untuk produk
Route::resource('/products', ProductController::class)->middleware('is_admin');
// Menampilkan daftar produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Menampilkan form untuk menambah produk
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Menyimpan produk baru
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Menampilkan form untuk mengedit produk
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Memperbarui produk
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
// Menghapus produk
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Rute untuk pelanggan dan keranjang
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::post('/cart', [CustomerController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CustomerController::class, 'viewCart'])->name('cart.view');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CustomerController::class, 'checkout'])->name('cart.checkout');


// Rute untuk produk berdasarkan jenis
Route::get('/makanan', [ProductController::class, 'makanan'])->name('products.makanan');
Route::get('/minuman', [ProductController::class, 'minuman'])->name('products.minuman');

// Rute untuk jenis produk
Route::get('/index', [ProductController::class, 'index'])->name('customer.index');

// Rute untuk update dan hapus produk dalam keranjang
Route::put('cart/update/{product_id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/remove/{product_id}', [CartController::class, 'remove'])->name('cart.remove');

// Route untuk menampilkan struk setelah checkout
Route::get('/receipt/{transactionId}', [CartController::class, 'showReceipt'])->name('receipt.show');

// Route untuk pencarian produk
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// route untuk cetak pdf
Route::get('/receipt/{transactionId}/download', [ReceiptController::class, 'downloadReceipt'])->name('receipt.download');

// Route untuk melihat detail transaksi per periode
Route::get('/transactions/{period}', [DashboardController::class, 'showTransactions'])->name('transactions.show');

// route foto profile
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');












