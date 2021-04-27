<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategorieController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('categories', [CategorieController::class,'getcategories']);
Route::get('subcategories/{id}', [CategorieController::class,'getsubcategories']);

Route::get('productByCategorie/{id}/{sort}', [CategorieController::class,'getProductsByCategorie']);
Route::get('subcategoriesProduct/{id}/{sort}', [CategorieController::class,'getProductsBySubCategorie']);


Route::get('products', [ProductController::class,'getproducts']);
Route::get('sortByPrice/{sort}/{categorieOrsubCategorie}', [ProductController::class,'getProductSortingByPrice']);
