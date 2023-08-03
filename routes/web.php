<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;


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

/*Route::get('/', function () {
    return view('welcome');
});*/
/*Frontend*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::get('/', function () {
    return view('frontend.index');
});



                                /*Backend*/



Route::prefix('back')->middleware(['auth','isAdmin'])->group(function ()
{
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    });

    Route::resource('category',CategoryController::class);
    Route::resource('brand',BrandController::class);
    Route::resource('product',ProductController::class);





    Route::get('CategoryDel/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('ProductImageDel/{id}',[ProductController::class,'ProductImageDel'])->name('product.ProductImageDel');
    Route::get('ProductDel/{id}',[ProductController::class,'delete'])->name('product.delete');




});
