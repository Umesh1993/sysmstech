<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;


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

Route::fallback(function () {
    return 'Page not Found';
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('login');
    });
    
    Route::get('register',[LoginController::class,'register_page']);
   
    Route::get('forgot-password',[LoginController::class,'forgotpasswordForm']);
    Route::post('forgot-password',[LoginController::class,'submitforgotpasswordForm']);

    Route::get('reset-password/{token}',[LoginController::class,'resetpasswordForm']);
    Route::post('reset-password',[LoginController::class,'submitresetpasswordForm']);
});

Route::post('login',[LoginController::class,'login'])->name('login');
Route::post('register-form',[LoginController::class,'register_form']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout',[LoginController::class,'logout']);

    //dashboard
    Route::get('dashboard',[HomeController::class,'index']);
    
    //product
    Route::get('product',[ProductController::class,'index']);
    Route::get('create-product',[ProductController::class,'add']);
    Route::get('update-product/{id}',[ProductController::class,'edit']);
    Route::post('insert-update-product',[ProductController::class,'store']);
    Route::post('delete-product',[ProductController::class,'destroy']);

    //category
    Route::get('category',[CategoryController::class,'index']);
    Route::post('delete-category',[CategoryController::class,'destroy']);
    
    
});
