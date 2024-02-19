<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { // admin only
    return view('dashboard');

    Route::prefix('/categories')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
    });
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('category/{category}', [CategoryController::class, 'show'])->name('category');
    Route::get('category/{category}/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategory');
});

Route::prefix('/product')->group(function () {
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
