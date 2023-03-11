<?php

use App\Http\Controllers\GenerateCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignedRouteController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','code'])->name('dashboard');

Route::get('/signed-route', [SignedRouteController::class, 'SignedRoute'])->name('signed-route');

Route::get('/input-code', function () {
    return view('input-code');
})->name('inputCode');

Route::post('/validate-code-web', [GenerateCodeController::class, 'storeWeb'])->name('codigoWeb');

Route::middleware(['auth','code'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
