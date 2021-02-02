<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\SendMail;

use App\Expense;
use App\User;

use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function getMostExpense()
    {
        $mostExpense = Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
                    ->whereYear('date', Carbon::now()->year)
                    ->groupBy('expenseMonth')
                    ->orderBy('totalExpense', 'DESC')
                    ->first();

        return response()->json([
          'data' => $mostExpense,
        ]);
    }

    public function getRecentExpense()
    {
        $recentExpense = Expense::with('Category')
                      ->orderBy('date', 'DESC')
                      ->first();

        if ($recentExpense != NULL) {
          return response()->json([
            'data' => $recentExpense,
          ]);
        }
        else {
          return response()->json([], 204);
        }
    }

    public function getLeastExpense()
    {
        $leastExpense = Expense::select(\DB::raw('MONTH(date) AS expenseMonth'), \DB::raw('SUM(amount) AS totalExpense'))
                    ->whereYear('date', Carbon::now()->year)
                    ->groupBy('expenseMonth')
                    ->orderBy('totalExpense', 'ASC')
                    ->first();

        return response()->json([
          'data' => $leastExpense,
        ]);
    }

    public function getTotalExpenseYearly()
    {
        $totalExpenseYearly = Expense::select(\DB::raw('YEAR(date) year'), \DB::raw('SUM(amount) AS totalExpense'))
                          ->groupby('year')
                          ->orderBy('year')
                          ->get();

        return response()->json([
          'data' => $totalExpenseYearly,
        ]);
    }

    public function getExpenseListYearly()
    {
        $expenseListYearly = Expense::select(\DB::raw('YEAR(date) year, MONTH(date) month'), \DB::raw('SUM(amount) AS totalExpense'), \DB::raw('COUNT(*) as times'))
                         ->groupby('year', 'month')
                         ->orderBy('year')
                         ->get();

        return response()->json([
          'data' => $expenseListYearly,
        ]);
    }

    public function getExpenseLocationCounts()
    {
        $expenseLocationCounts = Expense::select(\DB::raw('COUNT(*) as times'), \DB::raw('location'), \DB::raw('YEAR(date) year'))
                             ->groupBy('year', 'location')
                             ->get();

        return response()->json([
          'data' => $expenseLocationCounts,
        ]);
    }

    public function getCurrentMonthExpenses()
    {
        $currentMonthExpenses = Expense::with('Category')
                            ->whereYear('date', Carbon::now()->year)
                            ->whereMonth('date', Carbon::now()->month)
                            ->get();

        return response()->json([
          'data' => $currentMonthExpenses,
        ]);
    }

    public function getCategoriesGroupByLocation()
    {
        $categoriesGroupByLocation = Expense::select(\DB::raw('location'), \DB::raw('category_id'))
                         ->groupBy('category_id', 'location')
                         ->get();

        return response()->json([
          'data' => $categoriesGroupByLocation,
        ]);
    }

    public function getExpensePages()
    {
        $expensePages = Expense::with('Category')
                   ->orderby('date', 'DESC')
                   ->paginate(10);

        return response()->json($expensePages);
    }

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

        return response()->json([], 201);
    }
}
