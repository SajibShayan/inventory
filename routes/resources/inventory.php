<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Inventory\DestroyInventoryController;
use App\Http\Controllers\Admin\Inventory\IndexInventoryController;
use App\Http\Controllers\Admin\Inventory\StoreInventoryController;
use App\Http\Controllers\Admin\Inventory\UpdateInventoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    // task route
    Route::get('/', IndexInventoryController::class)->name('index');
    Route::post('/', StoreInventoryController::class)->name('store');
    Route::put('/{inventory}', UpdateInventoryController::class)->name('update');
    Route::delete('/{inventory}', DestroyInventoryController::class)->name('destroy');

});
