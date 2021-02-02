<?php




Auth::routes();


Route::get('/', 'MainController@index')->name('main');
