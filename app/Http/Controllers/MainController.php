<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Expense;
use DateInterval;
use DatePeriod;
use DateTime;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();

        $recentExpense = Expense::with('Category')
              ->orderBy('date', 'DESC')
              ->first();

        $control = Expense::first();
        if($control != NULL){
          $start = (new DateTime(Expense::orderBy('date', 'ASC')->first()->date))->modify('first day of this month');
          $end = (new DateTime($recentExpense->date))->modify('last day of this year');
          $intervalYears = DateInterval::createFromDateString('1 year');

          $yearsUnorganized = new DatePeriod($start, $intervalYears, $end);
          foreach ($yearsUnorganized as $yearUnorganized) {
              $years[] = ['value' => $yearUnorganized->format('Y')];
          }
        }
        else {
          $years = NULL;
        }
        
        return view('home')->with(compact(
            'categories',
            'years'
        ));
    }
}
