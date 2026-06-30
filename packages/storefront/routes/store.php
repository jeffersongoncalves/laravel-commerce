<?php

use Illuminate\Support\Facades\Route;
use JeffersonGoncalves\Commerce\Storefront\Http\Controllers\CartController;
use JeffersonGoncalves\Commerce\Storefront\Http\Controllers\OrderController;
use JeffersonGoncalves\Commerce\Storefront\Http\Controllers\ProductController;
use JeffersonGoncalves\Commerce\Storefront\Http\Middleware\EnsurePublishableApiKey;

Route::prefix('store')
    ->middleware([EnsurePublishableApiKey::class])
    ->group(function () {
        Route::get('products', [ProductController::class, 'index']);
        Route::post('carts', [CartController::class, 'store']);
        Route::post('carts/{cart}/line-items', [CartController::class, 'addLineItem']);
        Route::post('carts/{cart}/complete', [CartController::class, 'complete']);
        Route::get('orders/{order}', [OrderController::class, 'show']);
    });
