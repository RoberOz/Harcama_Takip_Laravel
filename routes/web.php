<?php




Auth::routes();


Route::get('/', 'MainController@index')->name('main');

Route::resource('store','StoreController',['only'=> ['store']]);
