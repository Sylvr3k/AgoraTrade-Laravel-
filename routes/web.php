<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MpesaController;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Http\Controllers\PurchaseController;


Route::post('/mpesa/stk-push', [MpesaController::class, 'stkPush'])->middleware('auth')->name('mpesa.push');
Route::post('/mpesa/callback', [MpesaController::class, 'callback'])->name('mpesa.callback');

Route::get('/purchases', [PurchaseController::class, 'index'])->middleware('auth')->name('purchases.index');

Route::get('/orders', [OrderController::class, 'index'])->middleware('auth')->name('orders.index');

Route::get('/listings', [ListingController::class, 'index'])->middleware('auth')->name('listings.index');
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth')->name('listings.create');
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth')->name('listings.store');
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->middleware('auth')->name('listings.destroy');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');;

// Named route for login page
Route::get('/login', function () {
    return view('login');
})->name('login');;

Route::get('/store', function () {
    return view('store');
})->name('store');;

Route::get('/profile', function () {
    return view('profile');
})->name('profile');;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/profile', [AuthController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile', [AuthController::class, 'update'])->name('profile.update');

Route::get('/auth-redirect', function() {
    return redirect()->route('login')->with('redirect', url()->previous());
})->name('auth.redirect');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Named route for signup page
Route::get('/signup', function () {
    return view('signup');
})->name('signup.form');

Route::get('/store', [StoreController::class, 'index'])->name('store');
Route::post('/orders', [StoreController::class, 'buy'])->middleware('auth')->name('orders.buy');

Route::post('/signup', [AuthController::class, 'store'])->name('signup.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
