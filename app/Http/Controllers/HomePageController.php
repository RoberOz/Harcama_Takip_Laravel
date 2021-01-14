<?php

namespace App\Http\Controllers;

use App\Category;
use App\Expense;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $expenses = Expense::all();

        $expensePages = Expense::orderby('date', 'DESC')->paginate(10);

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

        $listDatas = Expense::select(\DB::raw('YEAR(date) year, MONTH(date) month'), \DB::raw('SUM(amount) AS totalExpense'), \DB::raw('COUNT(*) as times'))
               ->groupby('year', 'month')
               ->orderBy('year')
               ->get();

        $totalExpenseYearly = Expense::select(\DB::raw('YEAR(date) year'), \DB::raw('SUM(amount) AS totalExpense'))
               ->groupby('year')
               ->orderBy('year')
               ->get();

        $expenseLocationCounts = Expense::select(\DB::raw('COUNT(*) as times'), \DB::raw('location'), \DB::raw('YEAR(date) year'))
               ->groupBy('year', 'location')
               ->get();

        $categoryLocations = Expense::select(\DB::raw('location'), \DB::raw('category_id'))
               ->groupBy('category_id', 'location')
               ->get();

        return view('home')->with(compact(
            'categories',
            'expenses',
            'expensePages',
            'mostExpense',
            'leastExpense',
            'currentMonthExpenses',
            'recentExpens',
            'years',
            'listDatas',
            'totalExpenseYearly',
            'expenseLocationCounts',
            'categoryLocations'
        ));
    }
}
