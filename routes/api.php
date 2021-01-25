<?php

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;



Route::get('/most-expense','Api\V1\ExpenseController@mostExpense');
Route::get('/recent-expense','Api\V1\ExpenseController@recentExpense');
Route::get('/least-expense','Api\V1\ExpenseController@leastExpense');
Route::get('/total-expense-yearly','Api\V1\ExpenseController@totalExpenseYearly');
Route::get('/list-datas','Api\V1\ExpenseController@listDatas');
Route::get('/expense-location-counts','Api\V1\ExpenseController@expenseLocationCounts');
Route::get('/current-month-expenses','Api\V1\ExpenseController@currentMonthExpenses');
Route::get('/category-locations','Api\V1\ExpenseController@categoryLocations');
Route::get('/expense-pages','Api\V1\ExpenseController@expensePages');

Route::post('/store','ResourceController@store');









Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
