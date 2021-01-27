<?php





Auth::routes();

Route::get('/', 'MainController@index')->name('main');
Route::resource('process','ResourceController',['only'=> ['store']]);
