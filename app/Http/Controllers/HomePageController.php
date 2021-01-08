<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomePageController extends Controller
{

  public function index()
    {
      $categories = Category::all();

      return view('home')->with(compact('categories'));
    }
}
