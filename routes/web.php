<?php










Route::get('/', 'HomePageController@index')->name('home');

Route::resource('process','ResourceController');
