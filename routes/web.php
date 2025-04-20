<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\HomeProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\subCategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

/* All Normal Users Routes List */
Route::middleware(['auth', 'user-access:user'])->group(function () {
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
});


/* All Admin Routes List */
Route::prefix('admin/')->as('admin.')->middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', subCategoryController::class);
    Route::get('/get-sub-category', [AjaxController::class, 'getSubCategory'])->name('get.subcategory');
    Route::resource('brand', BrandController::class);
    Route::resource('product', ProductController::class);
    Route::get('/product/trash/{id}', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::resource('slider', SliderController::class);
    Route::get('/slider/trash/{id}', [SliderController::class, 'trash'])->name('slider.trash');
    Route::get('/slider/restore/{id}', [SliderController::class, 'restore'])->name('slider.restore');
});


/* All Manager Routes List */
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/dashboard', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
});


/* Product Routes */
Route::get('/product/{slug}', [HomeProductController::class, 'productDetail'])->name('product.detail');
Route::get('/shop', [HomeProductController::class, 'products'])->name('products');
Route::get('/contact', [HomeProductController::class, 'contact'])->name('contact');
Route::get('brand/{slug}', [HomeProductController::class, 'brandProduct'])->name('brand.product');
Route::get('category/{category}/{subCategory?}', [HomeProductController::class, 'categoryProduct'])->name('category.product');

/* Cart Routes */
Route::group(['as' => 'cart.', 'prefix' => 'cart'], function () {
  Route::get('/', [CartController::class, 'index'])->name('index');
  Route::post('/add', [CartController::class, 'store'])->name('add');
  Route::post('/update', [CartController::class, 'update'])->name('update');
  Route::delete('/{product_id}', [CartController::class, 'destroy'])->name('destroy');
//   Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});

/* Checkout Routes */
// Route::middleware(['auth', 'user-access:user'])->group(function () {
// Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
// Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');
// });

/* SSLcommerz Routes */
// Route::post('/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');
// Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('payment.failed');
// Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('payment.cancel');
// Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('payment.ipn');