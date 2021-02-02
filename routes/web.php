<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/edit/{user:id}', [HomeController::class,'editSetting'])->name('edit');
// Route::put('/edit/{user:id}', [HomeController::class,'updateSetting']);

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('setting', [HomeController::class,'setting'])->name('setting');
    Route::match(['GET','PUT'],'/edit/{user:id}', [HomeController::class,'edit'])->name('edit');

});
Route::group(['middleware' => ['role:admin|kasir']], function () {
    Route::get('product', [HomeController::class,'product'])->name('product');
});
