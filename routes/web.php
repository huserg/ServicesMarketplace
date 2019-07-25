<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Visitor\VisitorSellableController@index');


Route::namespace('Client')->group(function (){

    Route::get('/home', 'ClientSellableController@index')->name('home');
    Route::get('/details/{id}', 'ClientSellableController@details')->name('client.sellable.details');

    // order CRUD
    Route::get('/orders', 'ClientOrderController@showAll')->name('client.orders');
    Route::post('/order/confirmation', 'ClientOrderController@order')->name('client.order');
    Route::post('/order/cancel', 'ClientOrderController@cancel')->name('client.order.cancel');
    Route::get('/order/{id}', 'ClientOrderController@showOrder')->name('client.order.details');
});

Route::namespace('Provider')->group(function (){
    Route::get('/dashboard', 'ProviderController@dashboard')->name('provider.menu');

    // sellables CRUD
    Route::get('/dashboard/sellable', 'ProviderSellableController@showSellable')->name('provider.sellable');
    Route::get('/dashboard/sellable/add', 'ProviderSellableController@addSellable')->name('provider.sellable.add');
    Route::post('/dashboard/sellable/add', 'ProviderSellableController@createSellable')->name('provider.sellable.create');
    Route::post('/dashboard/sellable/update', 'ProviderSellableController@updateSellable')->name('provider.sellable.update');
    Route::post('/dashboard/sellable/delete', 'ProviderSellableController@deleteSellable')->name('provider.sellable.delete');
    Route::get('/dashboard/sellable/{id}/manage', 'ProviderSellableController@manageSellable')->name('provider.sellable.manage');

    // order CRUD
    Route::get('/dashboard/orders', 'ProviderOrderController@showOrders')->name('provider.orders');
    Route::post('/dashboard/order/add', 'ProviderOrderController@addOrder')->name('provider.order.add');
    Route::post('/dashboard/order/create', 'ProviderOrderController@createOrder')->name('provider.order.create');
    Route::post('/dashboard/order/update', 'ProviderOrderController@updateOrder')->name('provider.order.update');
    Route::post('/dashboard/order/cancel', 'ProviderOrderController@cancelOrder')->name('provider.order.cancel');
    Route::post('/dashboard/order/delete', 'ProviderOrderController@deleteOrder')->name('provider.order.delete');
    Route::get('/dashboard/order/{id}', 'ProviderOrderController@showOrder')->name('provider.order.detail');
    Route::get('/dashboard/order/{id}/manage', 'ProviderOrderController@manageOrder')->name('provider.order.manage');

    Route::get('/dashboard/settings', 'ProviderController@showSettings')->name('provider.settings');

});

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');


Auth::routes(['verify' => true]);
