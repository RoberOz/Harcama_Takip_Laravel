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

      $most_expense=DB::table('expenses')
              ->whereYear('date','2020')
              ->groupBy(DB::raw("MONTH(date)"))
              ->orderBy('total_expense','DESC')
              ->take(1)
              ->get([DB::raw('MONTH(date) AS expense_month'), DB::raw('SUM(amount) AS total_expense')]);


      $least_expense=DB::table('expenses')
              ->whereYear('date','2020')
              ->groupBy(DB::raw("MONTH(date)"))
              ->orderBy('total_expense','ASC')
              ->take(1)
              ->get([DB::raw('MONTH(date) AS expense_month'), DB::raw('SUM(amount) AS total_expense')]);

      $recent_expens=DB::table('expenses')
              ->orderBy('date','DESC')
              ->latest()
              ->first();

      $this_month_expenses=DB::table('expenses')
               ->whereYear('date',Carbon::now()->year)
               ->whereMonth('date', Carbon::now()->month)
               ->get();


      return view('home')->with(compact('categories','expenses','most_expense','least_expense','this_month_expenses','recent_expens'));
    }
}
