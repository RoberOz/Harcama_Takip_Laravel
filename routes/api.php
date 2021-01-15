<?php

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;




Route::get('/pages','HomePageController@expensePages');
Route::get('/most-expense','HomePageController@mostExpense');
Route::get('/least-expense','HomePageController@leastExpense');
Route::get('/current-month-expenses','HomePageController@currentMonthExpenses');
Route::get('/recent-expens','HomePageController@recentExpens');
Route::get('/years','HomePageController@years');
Route::get('/list-datas','HomePageController@listDatas');
Route::get('/total-expense-yearly','HomePageController@totalExpenseYearly');
Route::get('/expense-location-counts','HomePageController@expenseLocationCounts');
Route::get('/category-locations','HomePageController@categoryLocations');

Route::post('/store','ResourceController@store');









Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
