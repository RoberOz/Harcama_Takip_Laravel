<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Expense;
use Carbon\Carbon;

class ExpenseController extends Controller
{

  public function mostExpense()
  {
    $mostExpense = Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
                    ->whereYear('date', Carbon::now()->year)
                    ->groupBy('expenseMonth')
                    ->orderBy('totalExpense', 'DESC')
                    ->first();

    return response($mostExpense);
  }

  public function recentExpense()
  {
    $recentExpense = Expense::with('Category')
                      ->orderBy('date', 'DESC')
                      ->first();

    return response($recentExpense);
  }

  public function leastExpense()
  {
    $leastExpense = Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
                    ->whereYear('date', Carbon::now()->year)
                    ->groupBy('expenseMonth')
                    ->orderBy('totalExpense', 'ASC')
                    ->first();

    return response($leastExpense);
  }

  public function totalExpenseYearly()
  {
    $totalExpenseYearly = Expense::select(\DB::raw('YEAR(date) year'), \DB::raw('SUM(amount) AS totalExpense'))
                          ->groupby('year')
                          ->orderBy('year')
                          ->get();

    return response($totalExpenseYearly);
  }

  public function listDatas()
  {
    $listDatas = Expense::select(\DB::raw('YEAR(date) year, MONTH(date) month'), \DB::raw('SUM(amount) AS totalExpense'), \DB::raw('COUNT(*) as times'))
                 ->groupby('year', 'month')
                 ->orderBy('year')
                 ->get();

    return response($listDatas);
  }

  public function expenseLocationCounts()
  {
    $expenseLocationCounts = Expense::select(\DB::raw('COUNT(*) as times'), \DB::raw('location'), \DB::raw('YEAR(date) year'))
                             ->groupBy('year', 'location')
                             ->get();

    return response($expenseLocationCounts);
  }

  public function currentMonthExpenses()
  {
    $currentMonthExpenses = Expense::with('Category')
                            ->whereYear('date', Carbon::now()->year)
                            ->whereMonth('date', Carbon::now()->month)
                            ->get();

    return response($currentMonthExpenses);
  }

  public function categoryLocations()
  {
    $categoryLocations = Expense::select(\DB::raw('location'), \DB::raw('category_id'))
                         ->groupBy('category_id', 'location')
                         ->get();

    return response($categoryLocations);
  }

  public function expensePages()
  {
    $expensePagination = Expense::with('Category')
                         ->orderby('date', 'DESC')
                         ->paginate(10);
    foreach ($expensePagination as $expensePaginate) {
      $expensePages[] = [
        'amount' => $expensePaginate->amount,
        'location' => $expensePaginate->location,
        'date' => $expensePaginate->date,
        'category_name' => $expensePaginate->category->name,
      ];
    }

    return response($expensePages);
  }
}
