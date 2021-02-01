<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

use App\Notifications\SendMail;
use App\User;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
        'amount' => 'required|numeric',
        'category_id' => 'required|integer|exists:categories,id',
        'location' => 'required|max:70',
        'date' => 'required|date',
      ]);

        $expense = new Expense();
        $expense->category_id = $request->category_id;
        $expense->amount = $request->amount;
        $expense->location = $request->location;
        $expense->date = $request->date;

        $expense->save();

        User::find(1)->notify(new SendMail($expense));
    }
}
