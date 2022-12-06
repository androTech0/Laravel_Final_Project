<?php

use Illuminate\Support\Facades\Route;


// User Index Routes
Route::get('/index', 'App\Http\Controllers\UserShowController@index');
Route::get('/index/search-products', 'App\Http\Controllers\UserShowController@searchProduct');
Route::get('/index/view-product-details/{id}', 'App\Http\Controllers\UserShowController@viewProductDetails');
Route::post('/index/save-transaction/{id}', 'App\Http\Controllers\PurchaseTransactionsController@savePurchase');

// login Routes
Route::get('/login', 'App\Http\Controllers\AdminController@login');
Route::get('/signup', 'App\Http\Controllers\AdminController@signup');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/submit-account', 'App\Http\Controllers\AdminController@signupPost');
Route::post('/login-account', 'App\Http\Controllers\AdminController@loginPost');
// Route::post('/edit-account/{id}', 'App\Http\Controllers\AdminController@editAccount');

// Store Routes
Route::get('/show-stores', 'App\Http\Controllers\StoresController@showStores');
Route::get('/create-store', 'App\Http\Controllers\StoresController@createStore');
Route::post('/save-store', 'App\Http\Controllers\StoresController@saveStore');
Route::get('/edit-store/{id}', 'App\Http\Controllers\StoresController@editStore');
Route::post('/update-store/{id}', 'App\Http\Controllers\StoresController@updateStore');
Route::get('/delete-store/{id}', 'App\Http\Controllers\StoresController@deleteStore');
Route::get('/restore-store/{id}', 'App\Http\Controllers\StoresController@restoreStore');

// Category Routes
Route::get('/show-categories', 'App\Http\Controllers\CategoriesController@showCategories');
Route::get('/create-category', 'App\Http\Controllers\CategoriesController@createCategory');
Route::post('/save-category', 'App\Http\Controllers\CategoriesController@saveCategory');
Route::get('/edit-category/{id}', 'App\Http\Controllers\CategoriesController@editCategory');
Route::post('/update-category/{id}', 'App\Http\Controllers\CategoriesController@updateCategory');
Route::get('/delete-category/{id}', 'App\Http\Controllers\CategoriesController@deleteCategory');
Route::get('/restore-category/{id}', 'App\Http\Controllers\CategoriesController@restoreCategory');

// Product Routes
Route::get('/show-products', 'App\Http\Controllers\ProductsController@showProducts');
Route::get('/show-store-products/{id}', 'App\Http\Controllers\ProductsController@showStoreProducts');
Route::get('/show-category-products/{id}', 'App\Http\Controllers\ProductsController@showCategoryProducts');
Route::get('/create-product', 'App\Http\Controllers\ProductsController@createProduct');
Route::post('/save-product', 'App\Http\Controllers\ProductsController@saveProduct');
Route::get('/edit-product/{id}', 'App\Http\Controllers\ProductsController@editProduct');
Route::post('/update-product/{id}', 'App\Http\Controllers\ProductsController@updateProduct');
Route::get('/delete-product/{id}', 'App\Http\Controllers\ProductsController@deleteProduct');
Route::get('/restore-product/{id}', 'App\Http\Controllers\ProductsController@restoreProduct');

// Purchase Routes
Route::get('/show-transactions', 'App\Http\Controllers\PurchaseTransactionsController@showPurchases');
Route::get('/create-transaction', 'App\Http\Controllers\PurchaseTransactionsController@createPurchase');
Route::post('/save-transaction', 'App\Http\Controllers\PurchaseTransactionsController@savePurchase');
Route::get('/edit-transaction/{id}', 'App\Http\Controllers\PurchaseTransactionsController@editPurchase');
Route::post('/update-transaction/{id}', 'App\Http\Controllers\PurchaseTransactionsController@updatePurchase');
Route::get('/delete-transaction/{id}', 'App\Http\Controllers\PurchaseTransactionsController@deletePurchase');
Route::get('/restore-transaction/{id}', 'App\Http\Controllers\PurchaseTransactionsController@restorePurchase');