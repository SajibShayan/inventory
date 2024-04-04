<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Item\IndexItemController;
use App\Http\Controllers\Admin\Item\StoreItemController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    // task route
    Route::get('/', IndexItemController::class)->name('index');
    Route::post('/', StoreItemController::class)->name('store');
    // Route::put('/{inventory}', UpdateInventoryController::class)->name('update');
    // Route::delete('/{inventory}', DestroyInventoryController::class)->name('destroy');

});
