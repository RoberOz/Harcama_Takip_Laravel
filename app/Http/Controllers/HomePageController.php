<?php

namespace App\Http\Controllers;

use App\Category;
use App\Expense;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;

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

        $start = (new DateTime(Expense::orderBy('date', 'ASC')->first()->date))->modify('first day of this month');
        $end = (new DateTime($recentExpens->date))->modify('first day of next year');
        $intervalYears = DateInterval::createFromDateString('1 year');

        $years = new DatePeriod($start, $intervalYears, $end);

        $listDatas=Expense::select(\DB::raw('YEAR(date) year, MONTH(date) month'), \DB::raw('SUM(amount) AS totalExpense'),\DB::raw('COUNT(*) as times'))
               ->groupby('year','month')
               ->orderBy('year')
               ->get();





        return view('home')->with(compact(
          'categories',
          'expenses',
          'mostExpense',
          'leastExpense',
          'currentMonthExpenses',
          'recentExpens',
          'years',
          'listDatas'
        ));
    }
}
