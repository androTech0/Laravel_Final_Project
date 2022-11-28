<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/index', function () {
    return view('pages\index');
});

// login Routes
Route::get('/login', 'App\Http\Controllers\AdminController@login');
Route::get('/signup', 'App\Http\Controllers\AdminController@signup');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/submit-account', 'App\Http\Controllers\AdminController@signupPost');
Route::post('/login-account', 'App\Http\Controllers\AdminController@loginPost');
// Route::post('/edit-account/{id}', 'App\Http\Controllers\AdminController@editAccount');

// Store Routes
Route::get('/show-stores','App\Http\Controllers\StoresController@showStores');
Route::get('/create-store','App\Http\Controllers\StoresController@createStore');
Route::post('/save-store','App\Http\Controllers\StoresController@saveStore');
Route::get('/edit-store/{id}','App\Http\Controllers\StoresController@editStore');
Route::post('/update-store/{id}','App\Http\Controllers\StoresController@updateStore');
Route::get('/delete-store/{id}','App\Http\Controllers\StoresController@deleteStore');
Route::get('/restore-store/{id}','App\Http\Controllers\StoresController@restoreStore');

// Category Routes
Route::get('/show-categories','App\Http\Controllers\CategoryController@showCategories');
Route::get('/create-category','App\Http\Controllers\CategoryController@createCategory');
Route::post('/save-category','App\Http\Controllers\CategoryController@saveCategory');
Route::get('/edit-category/{id}','App\Http\Controllers\CategoryController@editCategory');
Route::post('/update-category/{id}','App\Http\Controllers\CategoryController@updateCategory');
Route::get('/delete-category/{id}','App\Http\Controllers\CategoryController@deleteCategory');
Route::get('/restore-category/{id}','App\Http\Controllers\StoresController@restoreCategory');

// Product Routes
Route::get('/show-products','App\Http\Controllers\CategoryController@showProducts');
Route::get('/create-product','App\Http\Controllers\CategoryController@createProduct');
Route::post('/save-product','App\Http\Controllers\CategoryController@saveProduct');
Route::get('/edit-product/{id}','App\Http\Controllers\CategoryController@editProduct');
Route::post('/update-product/{id}','App\Http\Controllers\CategoryController@updateProduct');
Route::get('/delete-product/{id}','App\Http\Controllers\CategoryController@deleteProduct');
Route::get('/restore-product/{id}','App\Http\Controllers\StoresController@restoreProduct');

// Purchase Routes
Route::get('/show-purchases','App\Http\Controllers\CategoryController@showPurchases');
Route::get('/create-purchase','App\Http\Controllers\CategoryController@createPurchase');
Route::post('/save-purchase','App\Http\Controllers\CategoryController@savePurchase');
Route::get('/edit-purchase/{id}','App\Http\Controllers\CategoryController@editPurchase');
Route::post('/update-purchase/{id}','App\Http\Controllers\CategoryController@updatePurchase');
Route::get('/delete-purchase/{id}','App\Http\Controllers\CategoryController@deletePurchase');
Route::get('/restore-purchase/{id}','App\Http\Controllers\StoresController@restorePurchase');
