<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return [
        'api-version' => '1.0'
    ];
});

Route::resource(['ss' => ProductController::class]);

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{category:id}', [SubcategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::get('/{category}/{subcategory}', [SubcategoryController::class, 'show']);
});

require __DIR__ . '/auth.php';