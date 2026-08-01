<?php

use Illuminate\Support\Facades\Route;
use JeffersonGoncalves\Commerce\Admin\Http\Controllers\AdminOrderController;
use JeffersonGoncalves\Commerce\Admin\Http\Controllers\AdminProductController;
use JeffersonGoncalves\Commerce\Admin\Http\Middleware\EnsureSecretApiKey;

Route::prefix('admin/commerce')
    ->middleware([EnsureSecretApiKey::class])
    ->group(function () {
        Route::get('products', [AdminProductController::class, 'index']);
        Route::post('products', [AdminProductController::class, 'store']);
        Route::get('products/{product}', [AdminProductController::class, 'show']);
        Route::patch('products/{product}', [AdminProductController::class, 'update']);
        Route::delete('products/{product}', [AdminProductController::class, 'destroy']);

        Route::get('orders', [AdminOrderController::class, 'index']);
        Route::get('orders/{order}', [AdminOrderController::class, 'show']);
        Route::post('orders/{order}/returns', [AdminOrderController::class, 'storeReturn']);
        Route::post('orders/{order}/items', [AdminOrderController::class, 'storeItem']);
    });
