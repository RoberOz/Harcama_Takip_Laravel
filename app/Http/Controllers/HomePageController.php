<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Expense;
use DB;
use Carbon\Carbon;

class HomePageController extends Controller
{

  public function index()
    {
      $categories=Category::all();
      $expenses=Expense::all();

      $mostExpense=Expense::select(DB::raw('MONTH(date) AS expenseMonth'), DB::raw('SUM(amount) AS totalExpense'))
              ->whereYear('date',Carbon::now()->year)
              ->groupBy(DB::raw("MONTH(date)"))
              ->orderBy('totalExpense','DESC')
              ->take(1)
              ->get();


      $leastExpense=Expense::select(DB::raw('MONTH(date) AS expenseMonth'), DB::raw('SUM(amount) AS totalExpense'))
              ->whereYear('date',Carbon::now()->year)
              ->groupBy(DB::raw("MONTH(date)"))
              ->orderBy('totalExpense','ASC')
              ->take(1)
              ->get();

      $recentExpens=DB::table('expenses')
              ->orderBy('date','DESC')
              ->latest()
              ->first();

      $thisMonthExpenses=DB::table('expenses')
               ->whereYear('date',Carbon::now()->year)
               ->whereMonth('date', Carbon::now()->month)
               ->get();


      return view('home')->with(compact('categories','expenses','mostExpense','leastExpense','thisMonthExpenses','recentExpens'));
    }
}
