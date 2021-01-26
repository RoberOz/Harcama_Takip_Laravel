<?php







Route::get('/', 'MainController@index')->name('home');
Route::resource('process','ResourceController',['only'=> ['store']]);
