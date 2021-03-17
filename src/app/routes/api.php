<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => '/v1'], function () {
    Route::get('categories', 'API\CategoryController@index');
    Route::get('categories/{id}/items', 'API\CategoryController@categoryItems');
    Route::get('items', 'API\ItemController@index');
    Route::get('items/{id}', 'API\ItemController@show');
    Route::get('item/search', 'API\ItemController@search');
    Route::get('qrcode/{qr}', 'API\ThreadController@index');
    Route::post('order/create', 'API\OrderController@save');

    Route::get('/app/get/order/{hash}', 'API\OrderController@driverOrder');

    Route::get('/order/rest/select/{hash}/to/{order_id}', 'API\OrderController@sendOrderToDriver');
    Route::get('/app/approve/{order_id}', 'API\OrderController@approveOrder');
    Route::get('/app/{hash}/reject/{order_id}', 'API\OrderController@rejectOrder');
    Route::get('/app/{hash}/done/{order_id}', 'API\OrderController@completeOrder');
    Route::get('/order/get/{order_id}', 'API\OrderController@show');

    Route::get('/app/{hash}/tracking/{lat}/{lng}', 'API\DriverController@track');
    Route::get('/app/{hash}/check/active', 'API\DriverController@checkActive');
    Route::get('/app/{hash}/get/driver', 'API\DriverController@getDriver');
    Route::get('/app/{hash}/toggle', 'API\DriverController@toggle');
    Route::get('/app/{hash}/reset', 'API\DriverController@reset');
    Route::get('/app/{user_id}/drivers', 'API\DriverController@userDrivers');
    Route::get('fetch/driver/{driver_id}', 'API\DriverController@driverFetch');
});
