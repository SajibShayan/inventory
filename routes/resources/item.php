<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Item\DestroyItemController;
use App\Http\Controllers\Admin\Item\IndexItemController;
use App\Http\Controllers\Admin\Item\StoreItemController;
use App\Http\Controllers\Admin\Item\UpdateItemController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', IndexItemController::class)->name('index');
    Route::post('/', StoreItemController::class)->name('store');
    Route::put('/{item}', UpdateItemController::class)->name('update');
    Route::delete('/{item}', DestroyItemController::class)->name('destroy');

});
