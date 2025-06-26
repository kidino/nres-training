<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get(
    '/user', // first parameter
    [ 
        // second paramter as array -- ada 2 items
        UserController::class,
        'index' // second array item
    ]
)->name('user.index');

Route::middleware('auth')->group(function () {

    Route::get('product', [ ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ ProductController::class, 'create'])->name('product.create');
    Route::get('product/{product}/edit', [ ProductController::class, 'edit'])->name('product.edit');

    Route::post('product', [ ProductController::class, 'store'])->name('product.store');
    Route::put('product/{product}', [ ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product}', [ ProductController::class, 'destroy'])->name('product.destroy');

});

Route::get('/refresh-captcha', function () {
    return response()->json(['captcha' => captcha_img()]);
});




require __DIR__.'/auth.php';
