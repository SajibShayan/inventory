<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group([], function () {
    Route::prefix('inventories')->as('inventory:')
        ->group(
            base_path('routes/resources/inventory.php'),
        );
    Route::prefix('items')->as('items:')
        ->group(
            base_path('routes/resources/item.php'),
        );
});

Route::get('/dashboard', function () {
    // return Inertia::render('Dashboard');
    return redirect()->route('inventory:index');
})->middleware(['auth', 'verified'])->name('dashboard');


//define route for fetching image
Route::get('/images/{path}', fn (string $path) => response(
    Storage::get("public/images/$path"),
    200,
    [
        'Content-Type' => Storage::mimeType("public/images/$path"),
        'Cache-Control' => 'max-age=2630000, public',
    ]
));