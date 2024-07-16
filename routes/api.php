<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');


    // Customers
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/getcustomer', 'getCustomer'); // get customer
        Route::post('postcustomer', 'postCustomer'); // create customer
        Route::get('editcustomer/{uuidCustomer}', 'editCustomer'); // get customer info
        Route::post('updatecustomer/{uuidCustomer}', 'updateCustomer'); // update customer 
    });

    // Suppliers
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/getsupplier', 'getSupplier'); // get supplier
        Route::post('postsupplier', 'postSupplier'); // create supplier
        Route::get('editsupplier/{uuidSupplier}', 'editSupplier'); // get supplier info
        Route::post('updatesupplier/{uuidSupplier}', 'updateSupplier'); // update supplier 
    });

    // Products
    Route::controller(ProductController::class)->group(function () {
        Route::get('/getproduct', 'getProduct'); // get product
        Route::post('postproduct', 'postProduct'); // create product
        Route::get('editproduct/{uuidProduct}', 'editProduct'); // get product info
        Route::post('updateproduct/{uuidProduct}', 'updateProduct'); // update product 
        Route::post('updatequantity/{uuidProduct}', 'updateQuantity'); // update Stock
        Route::get('getproductprice/{uuidProduct}', 'getProductPrice'); 
        Route::get('getproductquantity/{uuidProduct}', 'getProductQuantity'); 
    });

    // Products
    Route::controller(OrderController::class)->group(function () {
        Route::get('/getorder', 'getorder'); // get order
        Route::post('postorder', 'postOrder'); // create order
        Route::get('editorder/{uuidOrder}', 'editOrder'); // get order info
    });

    Route::get('dashboard', [DashboardController::class, 'index']);

});
