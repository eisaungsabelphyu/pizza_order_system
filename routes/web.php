<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


    Route::middleware(['admin_auth'])->group(function(){
        //login,register
        Route::redirect('/', 'loginPage');
        Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
        Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');


    });

    Route::middleware(['auth'])->group(function () {

        //dashboard
        Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

        Route::middleware(['admin_auth'])->group(function(){
            //category
            Route::group(['prefix' => 'category'],function (){
                Route::get('/list',[CategoryController::class,'list'])->name('category#list');
                Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
                Route::post('create',[CategoryController::class,'create'])->name('category#create');
                Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
                Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
                Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });
            //admin account
            Route::prefix('admin')->group(function(){
                //password
                Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('auth#changePasswordPage');
                Route::post('change/password',[AdminController::class,'changePassword'])->name('auth#changePassword');

                //profile
                Route::get('details',[AdminController::class,'details'])->name('admin#details');
                Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
                Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

                //admin list
                Route::get('list',[AdminController::class,'list'])->name('admin#list');
                Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
                // Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
                // Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');

                //ajax change role
                Route::get('ajax/change/role',[AdminController::class,'ajaxChangeRole'])->name('admin#ajaxChangeRole');
            });

            //Products
            Route::prefix('product')->group(function(){
                Route::get('list',[ProductController::class,'list'])->name('product#list');
                Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
                Route::post('create',[ProductController::class,'create'])->name('product#create');
                Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
                Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
                Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
                Route::post('update',[ProductController::class,'update'])->name('product#update');
            });

            //Order
            Route::prefix('order')->group(function(){
                Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
                Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
                Route::get('ajax/status/change',[OrderController::class,'statusChange'])->name('admin#statusChange');
                Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
            });

            //Order
            Route::prefix('user')->group(function(){
                Route::get('list',[UserController::class,'userList'])->name('admin#userList');
                Route::get('change/role',[UserController::class,'userChangeRole'])->name('admin#userChangeRole');
                Route::get('delete/{id}',[UserController::class,'delete'])->name('admin#userDelete');

            });

            //Contact
            Route::prefix('contact')->group(function(){
                Route::get('list',[ContactController::class,'contactList'])->name('admin#contactList');
                Route::get('delete/{id}',[ContactController::class,'contactDelete'])->name('admin#contactDelete');

            });
        });


        //user
        Route::group(['prefix'=>'user','middleware' => 'user_auth'],function(){
            Route::get('homePage',[UserController::class,'home'])->name('user#home');
            Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
            Route::get('history',[UserController::class,'history'])->name('user#history');

            //pizza detail
            Route::prefix('pizza')->group(function(){
                Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('pizza#pizzaDetails');
            });

            //cart list page
            Route::prefix('cart')->group(function(){
                Route::get('list',[UserController::class,'cartList'])->name('cart#cartList');
            });

            //user change password
            Route::prefix('password')->group(function(){
                Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
                Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
            });

            //user account change
            Route::prefix('account')->group(function(){
                Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
                Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
            });

            //ajax data
            Route::prefix('ajax')->group(function(){
                Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
                Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
                Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
                Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
                Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
                Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
            });

            //contact
            Route::get('contactPage',[ContactController::class,'contact'])->name('user#contact');
            Route::post('create/contact',[ContactController::class,'createContact'])->name('user#createContact');


        });

    });

