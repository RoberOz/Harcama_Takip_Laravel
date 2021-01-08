<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Expense;

class HomePageController extends Controller
{

  public function index()
    {
      $categories = Category::all();
      $expenses = Expense::all();

      return view('home')->with(compact('categories','expenses'));
    }
}
