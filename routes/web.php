<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

// Category Routes
Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
    Route::get('/admin/category/index', 'index');
    Route::get('/admin/category/create', 'create');
    Route::post('/admin/category/index', 'store');
    Route::get('/admin/category/{category}/edit', 'edit');
    Route::put('admin/category/index/{category}', 'update');

});

Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
    Route::get('/admin/products/index', 'index');
    Route::get('/admin/products/create', 'create');

}); 

Route::post('/index', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('index');



Route::get('/admin/brand/index', App\Http\Livewire\Admin\Brand\Index::class);





