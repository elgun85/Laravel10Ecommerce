<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;

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

//Route::get('/home', [HomeController::class, 'index'])->name('home');




/*Route::get('/', function () {
    return view('frontend.index');
});*/

Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/{category_slug}', [FrontendController::class, 'product'])->name('product');
Route::get('/cat/{cat_slug}/{prod_view}', [FrontendController::class, 'product_view'])->name('product_view');
/*Route::get('/category', [FrontendController::class, 'category'])->name('category');*/


                                /*Backend*/



Route::prefix('back')->middleware(['auth','isAdmin'])->group(function ()
{
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    });

    Route::resource('category',CategoryController::class);
    Route::resource('brand',BrandController::class);
    Route::resource('product',ProductController::class);
    Route::resource('color',ColorController::class);
    Route::resource('slider',SliderController::class);





    Route::get('CategoryDel/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('ProductImageDel/{id}',[ProductController::class,'ProductImageDel'])->name('product.ProductImageDel');
    Route::get('ColorDel/{id}',[ColorController::class,'delete'])->name('color.delete');
    Route::get('ProductDel/{id}',[ProductController::class,'delete'])->name('product.delete');
    Route::get('SliderDel/{id}',[SliderController::class,'delete'])->name('slider.delete');
    Route::get('test_1',[ProductController::class,'test'])->name('test');




});
