<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/list',[RouteController::class,'getData']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::post('create/category',[RouteController::class,'createCategory']);

Route::get('delete/category/{id}',[RouteController::class,'deleteCategory']);
Route::post('category/details',[RouteController::class,'categoryDetails']);
Route::post('update/category',[RouteController::class,'updateCategory']);


/**
 * localhost:8000/api/product/list =>(get) product data
 *
 * localhost:8000/api/user/list =>(get) get user data list
 *
 * localhost:8000/api/order/list =>(get) order list
 *
 * localhost:8000/api/category/list =>(get) category list
 * localhost:8000/api/create/category =>(post) create category data
 *
 * localhost:8000/api/delete/category/7 =>(get) delete category by get method
 *
 * localhost:8000/api/category/details =>(post) get category's data details
 * key(id,name)
 *
 *localhost:8000/api/update/category =>(post) update category
 *key(category_name,category_id)

 */
