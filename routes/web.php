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


Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');


Auth::routes(['verify' => true]);
