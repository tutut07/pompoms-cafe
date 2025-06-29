<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoffeeController;

// Route untuk halaman home
Route::get('/', [CoffeeController::class, 'index']); // Memanggil metode index()


// Route untuk halaman menu
Route::get('/menu', [CoffeeController::class, 'menu'])->name('menu');

// Route untuk menyimpan data menu baru
Route::post('/menu/store', [CoffeeController::class, 'store'])->name('menu.store');

// Route untuk halaman about
Route::get('/about', function () {
    return view('halaman.about');
});

// Route untuk halaman contact us
Route::get('/contact', [CoffeeController::class, 'contact'])->name('halaman.contact');
Route::post('/contact', [CoffeeController::class, 'submitContact'])->name('halaman.submit');

Route::get('/login', [CoffeeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CoffeeController::class, 'login'])->name('login.submit');

Route::get('/home', [CoffeeController::class, 'home'])->name('home');
// Rute untuk menambahkan item ke keranjang
Route::post('/cart/add/{id}', [CoffeeController::class, 'addToCart'])->name('cart.add');

// Rute untuk menghapus item dari keranjang
Route::post('/cart/remove/{id}', [CoffeeController::class, 'removeFromCart'])->name('cart.remove');

// Rute untuk menampilkan keranjang
Route::get('/cart', [CoffeeController::class, 'viewCart'])->name('cart.view');

// Rute untuk halaman pembayaran
Route::get('/payment', [CoffeeController::class, 'showPaymentPage'])->name('payment');
Route::post('/payment/submit', [CoffeeController::class, 'processPayment'])->name('payment.submit');

// Route untuk menampilkan halaman nota (receipt)
Route::get('/receipt/{orderId}', [PaymentController::class, 'showReceipt'])->name('receipt');

// Rute untuk menampilkan form tambah/edit menu
Route::get('/editmenu/{id?}', [CoffeeController::class, 'editMenu'])->name('menu.edit');
Route::post('/menu/store', [CoffeeController::class, 'store'])->name('menu.store');
Route::put('/menu/update/{id}', [CoffeeController::class, 'update'])->name('menu.update');
Route::delete('/menu/delete/{id}', [CoffeeController::class, 'destroy'])->name('menu.delete'); // Tambahkan ini

Route::post('/payment', [CoffeeController::class, 'processPayment'])->name('payment.submit');
Route::get('/payment/success/{orderId}', [CoffeeController::class, 'success'])->name('order.success');
Route::get('/receipt/{orderId}', [CoffeeController::class, 'showReceipt'])->name('receipt');
// routes/web.php
Route::get('/success/{parameter}', [CoffeeController::class, 'success']);
Route::get('/order/success/{orderId}', [CoffeeController::class, 'success'])->name('order.success');
Route::get('/', [CoffeeController::class, 'index'])->name('home');
Route::get('/manage-orders', [CoffeeController::class, 'manageOrders'])->name('manage.orders');
Route::delete('/orders/{order}', [CoffeeController::class, 'deleteOrder'])->name('orders.destroy');
Route::get('/manage', [CoffeeController::class, 'manageOrders'])->name('manage.orders');
