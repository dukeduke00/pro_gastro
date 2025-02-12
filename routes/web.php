<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [ProductController::class, 'single'])->name('product.single');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart.all');

Route::get('/cart/finish', [CartController::class, 'finish'])->name('cart.finish');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/product/create', function (){
        return view('product.create');
    })->name('product.create');

    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('product.store');

    Route::get('/admin/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

    Route::post('/admin/product/save/{id}', [ProductController::class, 'save'])->name('product.save');
});

require __DIR__.'/auth.php';
