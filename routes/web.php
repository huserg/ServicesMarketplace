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
    Route::get('/management/sellable', 'ProviderController@showSellable')->name('provider.sellable');
    Route::get('/management/sellable/{id}/manage', 'ProviderController@manageSellable')->name('provider.sellable.manage');
    Route::get('/management/sellable/add', 'ProviderController@addSellable')->name('provider.sellable.add');
    Route::post('/management/sellable/add', 'ProviderController@createSellable')->name('provider.sellable.create');
    Route::post('/management/sellable/update', 'ProviderController@updateSellable')->name('provider.sellable.update');
    Route::post('/management/sellable/delete', 'ProviderController@deleteSellable')->name('provider.sellable.delete');

    // order CRUD
    Route::get('/management/sellable/{id}/order', 'ProviderController@orderSellable')->name('provider.sellable.order');

    Route::get('/management/settings', 'ProviderController@showSettings')->name('provider.settings');

});

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');


Auth::routes(['verify' => true]);
