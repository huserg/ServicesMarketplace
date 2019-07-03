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
    Route::post('/order/confirm', 'ClientSellableController@order')->name('client.order');
});

Route::namespace('Provider')->group(function (){
    Route::get('/management', 'ProviderController@dashboard')->name('provider.menu');

    // sellables CRUD
    Route::get('/management/sellable', 'ProviderSellableController@showSellable')->name('provider.sellable');
    Route::get('/management/sellable/add', 'ProviderSellableController@addSellable')->name('provider.sellable.add');
    Route::post('/management/sellable/add', 'ProviderSellableController@createSellable')->name('provider.sellable.create');
    Route::post('/management/sellable/update', 'ProviderSellableController@updateSellable')->name('provider.sellable.update');
    Route::post('/management/sellable/delete', 'ProviderSellableController@deleteSellable')->name('provider.sellable.delete');
    Route::get('/management/sellable/{id}/manage', 'ProviderSellableController@manageSellable')->name('provider.sellable.manage');

    // order CRUD
    Route::get('/management/orders', 'ProviderOrderController@showOrders')->name('provider.orders');
    Route::post('/management/order/add', 'ProviderOrderController@addOrder')->name('provider.order.add');
    Route::post('/management/order/create', 'ProviderOrderController@createOrder')->name('provider.order.create');
    Route::post('/management/order/update', 'ProviderOrderController@updateOrder')->name('provider.order.update');
    Route::get('/management/order/delete', 'ProviderOrderController@deleteOrder')->name('provider.order.delete');
    Route::get('/management/order/{id}', 'ProviderOrderController@showOrder')->name('provider.order.detail');
    Route::get('/management/order/{id}/manage', 'ProviderOrderController@manageOrder')->name('provider.order.manage');

    Route::get('/management/settings', 'ProviderController@showSettings')->name('provider.settings');

});

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');


Auth::routes(['verify' => true]);
