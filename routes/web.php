<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Dash\ProductController as DashProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dash\CategoryController as DashCategoryController;
use App\Http\Controllers\Dash\SubcategoryController as DashSubcategoryController;
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
        Route::post('/', [DashCategoryController::class, 'store'])->name('category.store');
        Route::get('/create', [DashCategoryController::class, 'create'])->name('category.create');
        Route::get('/edit/{category}', [DashCategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/update/{category}', [DashCategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{category}', [DashCategoryController::class, 'destroy'])->name('category.destroy');
    });

    Route::prefix('/category/{category}')->group(function () {
        // Route::get('/', [DashSubcategoryController::class, 'index'])->name('subcategories')
        Route::post('/', [DashSubcategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/create', [DashSubcategoryController::class, 'create'])->name('subcategory.create');
        Route::get('/edit/{subcategory}', [DashSubcategoryController::class, 'edit'])->name('subcategory.edit');
        Route::patch('/update/{subcategory}', [DashSubcategoryController::class, 'update'])->name('subcategory.update');
        Route::delete('/delete/{subcategory}', [DashSubcategoryController::class, 'destroy'])->name('subcategory.destroy');
    });


    Route::prefix('products')->group(function () {
        Route::get('/', [DashProductController::class, 'index'])->name('products');
        Route::post('/', [DashProductController::class, 'store'])->name('product.store');
        Route::get('/create', [DashProductController::class, 'create'])->name('products.create');
        Route::get('/edit/{product}', [DashProductController::class, 'edit'])->name('product.edit');
        Route::patch('/update/{product}', [DashProductController::class, 'update'])->name('product.update');
        Route::delete('/delete/{product}', [DashProductController::class, 'destroy'])->name('product.delete');
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
