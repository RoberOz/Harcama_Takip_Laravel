<?php

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;



Route::group([
  'namespace' =>'Api\V1',
  'prefix' => '/'
],  function () {
  Route::get('most-expense','ExpenseController@getMostExpense');
  Route::get('recent-expense','ExpenseController@getRecentExpense');
  Route::get('least-expense','ExpenseController@getLeastExpense');
  Route::get('total-expense-yearly','ExpenseController@getTotalExpenseYearly');
  Route::get('expense-list-yearly','ExpenseController@getExpenseListYearly');
  Route::get('expense-location-counts','ExpenseController@getExpenseLocationCounts');
  Route::get('current-month-expenses','ExpenseController@getCurrentMonthExpenses');
  Route::get('categories-group-by-location','ExpenseController@getCategoriesGroupByLocation');
  Route::get('expense-pages','ExpenseController@getExpensePages');
  Route::post('store','ExpenseController@store');
});










Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
