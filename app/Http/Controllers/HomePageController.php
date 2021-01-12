<?php

namespace App\Http\Controllers;

use App\Category;
use App\Expense;
use Carbon\Carbon;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $expenses = Expense::orderby('date')->Paginate(10);

        $mostExpense = Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
              ->whereYear('date', Carbon::now()->year)
              ->groupBy('expenseMonth')
              ->orderBy('totalExpense', 'DESC')
              ->first();

        $leastExpense = Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
              ->whereYear('date', Carbon::now()->year)
              ->groupBy('expenseMonth')
              ->orderBy('totalExpense', 'ASC')
              ->first();

        $recentExpens = Expense::orderBy('date', 'DESC')
              ->first();

        $currentMonthExpenses = Expense::whereYear('date', Carbon::now()->year)
               ->whereMonth('date', Carbon::now()->month)
               ->get();


        return view('home')->with(compact('categories', 'expenses', 'mostExpense', 'leastExpense', 'currentMonthExpenses', 'recentExpens'));
    }
}
