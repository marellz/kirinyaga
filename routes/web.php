<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Dash\ProductController as DashProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashCategoryController;
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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('dashboard')->name('dash.')->group(function () { // admin only

    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::prefix('/categories')->group(function () {
        Route::get('/', [DashCategoryController::class, 'index'])->name('categories');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [DashProductController::class, 'index'])->name('products');
        Route::post('/', [DashProductController::class, 'store'])->name('product.store');
        Route::get('/create', [DashProductController::class, 'create'])->name('products.create');
        Route::get('/{product}/edit', [DashProductController::class, 'edit'])->name('product.edit');
        Route::patch('/{product}', [DashProductController::class, 'update'])->name('product.update');
        Route::delete('/{product}', [DashProductController::class, 'destroy'])->name('product.delete');
    });
})->middleware(['auth', 'verified'])->name('dash.');


Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
});

Route::prefix('/product')->group(function () {
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
