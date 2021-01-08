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

      $most=DB::table('expenses')
              ->groupBy('id')
              ->get(['id',DB::raw('MAX(id) as id')]);

      // 2020 yılı ve 08 ayını getirdi
      $least=DB::table('expenses')
               ->whereYear('date','2020')
               ->whereMonth('date', '08')
               ->get();

      // şuanki yılı ve şuanki ayı getirir
      $this_month_expenses=DB::table('expenses')
               ->whereYear('date',Carbon::now()->year)
               ->whereMonth('date', Carbon::now()->month)
               ->get();

      // son girilen işlemi alır
      $recent_expens=DB::table('expenses')
              ->orderBy('date','desc')
              ->latest()
              ->first();


      return view('home')->with(compact('categories','expenses','most','least','this_month_expenses','recent_expens'));
    }
}
