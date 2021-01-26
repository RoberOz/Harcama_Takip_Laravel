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

class MainController extends Controller
{
    public function index()
    {

        $categories = Category::all();

        $recentExpense = Expense::with('Category')
              ->orderBy('date', 'DESC')
              ->first();

        $start = (new DateTime(Expense::orderBy('date', 'ASC')->first()->date))->modify('first day of this month');
        $end = (new DateTime($recentExpense->date))->modify('last day of this year');
        $intervalYears = DateInterval::createFromDateString('1 year');

        $yearsUnorganized = new DatePeriod($start, $intervalYears, $end);
        foreach ($yearsUnorganized as $yearUnorganized) {
          $years[] = ['value' => $yearUnorganized->format('Y')];
        }

        return view('home')->with(compact(
            'categories',
            'years'
        ));

    }
}
