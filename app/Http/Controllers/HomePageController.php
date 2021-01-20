<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Expense;
use App\Http\Resources\ExpenseCollection;

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

        $expensePages = Expense::with('Category')
              ->orderby('date', 'DESC')
              ->paginate(10);

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

        $recentExpense = Expense::with('Category')
              ->orderBy('date', 'DESC')
              ->first();

        $currentMonthExpenses = Expense::with('Category')
               ->whereYear('date', Carbon::now()->year)
               ->whereMonth('date', Carbon::now()->month)
               ->get();

        $start = (new DateTime(Expense::orderBy('date', 'ASC')->first()->date))->modify('first day of this month');
        $end = (new DateTime($recentExpense->date))->modify('first day of next year');
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
            'recentExpense',
            'years',
            'listDatas',
            'totalExpenseYearly',
            'expenseLocationCounts',
            'categoryLocations',
        ));

    }

    public function expensePages()
    {
      return Expense::orderby('date', 'DESC')->paginate(10);
    }

    public function mostExpense()
    {
      return Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
                ->whereYear('date', Carbon::now()->year)
                ->groupBy('expenseMonth')
                ->orderBy('totalExpense', 'DESC')
                ->first();
    }

    public function leastExpense()
    {
      return Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
                ->whereYear('date', Carbon::now()->year)
                ->groupBy('expenseMonth')
                ->orderBy('totalExpense', 'ASC')
                ->first();
    }

    public function currentMonthExpenses()
    {
      return Expense::whereYear('date', Carbon::now()->year)
                ->whereMonth('date', Carbon::now()->month)
                ->get();
    }

    public function recentExpens()
    {
      return Expense::with('Category')
            ->orderBy('date', 'DESC')
            ->first();
    }
/*
    public function years()
    {
          $start = (new DateTime(Expense::orderBy('date', 'ASC')->first()->date))->modify('first day of this month');
          $end = (new DateTime($recentExpens->date))->modify('first day of next year');
          $intervalYears = DateInterval::createFromDateString('1 year');

          $years = new DatePeriod($start, $intervalYears, $end);

          return $years;
    }
*/
    public function listDatas()
    {
      return Expense::select(\DB::raw('YEAR(date) year, MONTH(date) month'), \DB::raw('SUM(amount) AS totalExpense'), \DB::raw('COUNT(*) as times'))
               ->groupby('year', 'month')
               ->orderBy('year')
               ->get();
    }

    public function totalExpenseYearly()
    {
      return Expense::select(\DB::raw('YEAR(date) year'), \DB::raw('SUM(amount) AS totalExpense'))
              ->groupby('year')
              ->orderBy('year')
              ->get();
    }

    public function expenseLocationCounts()
    {
      return Expense::select(\DB::raw('COUNT(*) as times'), \DB::raw('location'), \DB::raw('YEAR(date) year'))
              ->groupBy('year', 'location')
              ->get();
    }

    public function categoryLocations()
    {
      return Expense::select(\DB::raw('location'), \DB::raw('category_id'))
              ->groupBy('category_id', 'location')
              ->get();
    }
}
