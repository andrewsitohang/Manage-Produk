<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::get('',[AuthController::class,'index'])->name('login');
Route::post('login/process',[AuthController::class,'loginProcess'])->name('login.process');


Route::middleware(['auth'])->group(function () {
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    
    Route::get('profile',[AuthController::class,'profile'])->name('profile');
    Route::post('profile/update',[AuthController::class,'profileUpdate'])->name('profile.update');
    Route::post('password/update',[AuthController::class,'passwordUpdate'])->name('password.update');
    
    Route::get('product/export',[ProductController::class,'export'])->name('product.export');
    Route::resource('product',ProductController::class);
});
