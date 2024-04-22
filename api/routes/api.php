<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'api-version' => '1.0'
    ]);
});

Route::resources([
    'products' => ProductController::class,
    'categories' => CategoryController::class,
    'subcategories' => SubcategoryController::class,
]);

require __DIR__ . '/auth.php';
