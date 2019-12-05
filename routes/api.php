<?php

use Illuminate\Http\Request;

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

/**
 * API V1
 */

//Route::domain('api.'.env('APP_DOMAIN'))->group(function () {

    Route::prefix('v1')->group(function () {
        /**
         * USER SIDE
         */
        Route::post('register', 'v1\User\UserController@register'); // Register User

        Route::post('login', 'v1\User\UserController@login'); // Logun User

        /**
         * Products
         */
        Route::get('products/{no}', 'v1\ProductController@products'); // Get all products w/paginate
        Route::get('products', 'v1\ProductController@products'); // Get all products
        
        Route::get('product/{product_id}', 'v1\ProductController@product'); // Get single product
        
        /**
         * Categories
         */
        Route::get('categories/{no}', 'v1\CategoryController@categories'); // Get all category w/paginate
        Route::get('categories', 'v1\CategoryController@categories'); // Get all category



        Route::prefix('a')->group(function () {
            /**
             * ADMIN
             */
            Route::post('register', 'v1\Admin\AdminController@register');  // Register User

            Route::post('login', 'v1\Admin\AdminController@login'); // Login User
            
            Route::middleware('auth:api')->group(function () { // Logedin  User Functions
                
                Route::get('account/details', 'v1\Admin\AdminController@account_details'); // View User Details

                /**
                 * PRODUCTS
                 */
                //Route::get('products', 'v1\ProductController@products'); // Get all products
        
                //Route::get('product/{product_id}', 'v1\ProductController@product'); // Get single product

                Route::post('product', 'v1\ProductController@add_product'); // Add Product

                Route::put('product', 'v1\ProductController@update_product'); // Update Product

                Route::delete('product/{product_id}', 'v1\ProductController@delete_product'); // Delete Product

                /**
                 * CATEGORIES
                 */
                Route::post('category', 'v1\CategoryController@add_category'); // Add Categories

                Route::put('category', 'v1\CategoryController@update_category'); // Update Product

                Route::delete('category/{category_id}', 'v1\CategoryController@delete_category'); // Delete Product
            });
        });
    });