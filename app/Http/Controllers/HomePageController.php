<?php

namespace App\Http\Controllers;

use App\Category;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $mostExpense = Expense::select(DB::raw('MONTH(date) AS expenseMonth'), DB::raw('SUM(amount) AS totalExpense'))
              ->whereYear('date', Carbon::now()->year)
              ->groupBy('expenseMonth')
              ->orderBy('totalExpense', 'DESC')
              ->first();

        $leastExpense = Expense::select(DB::raw('MONTH(date) AS expenseMonth'), DB::raw('SUM(amount) AS totalExpense'))
              ->whereYear('date', Carbon::now()->year)
              ->groupBy('expenseMonth')
              ->orderBy('totalExpense', 'ASC')
              ->first();

        $recentExpens = Expense::select()
              ->orderBy('date', 'DESC')
              ->first();

        $currentMonthExpenses = Expense::select()
               ->whereYear('date', Carbon::now()->year)
               ->whereMonth('date', Carbon::now()->month)
               ->get();

        return view('home')->with(compact('categories', 'mostExpense', 'leastExpense', 'currentMonthExpenses', 'recentExpens'));
    }
}
