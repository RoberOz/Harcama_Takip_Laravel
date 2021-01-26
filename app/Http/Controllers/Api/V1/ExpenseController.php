<?php

namespace App\Http\Controllers\Api\V1;

use App\Expense;
use App\Http\Controllers\Controller;
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

        return response()->json($mostExpense);
    }

    public function recentExpense()
    {
        $recentExpense = Expense::with('Category')
                      ->orderBy('date', 'DESC')
                      ->first();

        return response()->json($recentExpense);
    }

    public function leastExpense()
    {
        $leastExpense = Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
                    ->whereYear('date', Carbon::now()->year)
                    ->groupBy('expenseMonth')
                    ->orderBy('totalExpense', 'ASC')
                    ->first();

        return response()->json($leastExpense);
    }

    public function totalExpenseYearly()
    {
        $totalExpenseYearly = Expense::select(\DB::raw('YEAR(date) year'), \DB::raw('SUM(amount) AS totalExpense'))
                          ->groupby('year')
                          ->orderBy('year')
                          ->get();

        return response()->json($totalExpenseYearly);
    }

    public function listDatas()
    {
        $listDatas = Expense::select(\DB::raw('YEAR(date) year, MONTH(date) month'), \DB::raw('SUM(amount) AS totalExpense'), \DB::raw('COUNT(*) as times'))
                 ->groupby('year', 'month')
                 ->orderBy('year')
                 ->get();

        return response()->json($listDatas);
    }

    public function expenseLocationCounts()
    {
        $expenseLocationCounts = Expense::select(\DB::raw('COUNT(*) as times'), \DB::raw('location'), \DB::raw('YEAR(date) year'))
                             ->groupBy('year', 'location')
                             ->get();

        return response()->json($expenseLocationCounts);
    }

    public function currentMonthExpenses()
    {
        $currentMonthExpenses = Expense::with('Category')
                            ->whereYear('date', Carbon::now()->year)
                            ->whereMonth('date', Carbon::now()->month)
                            ->get();

        return response()->json($currentMonthExpenses);
    }

    public function categoryLocations()
    {
        $categoryLocations = Expense::select(\DB::raw('location'), \DB::raw('category_id'))
                         ->groupBy('category_id', 'location')
                         ->get();

        return response()->json($categoryLocations);
    }

    public function expensePages()
    {
        $expensePages = Expense::with('Category')
                   ->orderby('date', 'DESC')
                   ->paginate(10);

        return response()->json($expensePages);
    }
}
