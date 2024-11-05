<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (auth()->user()->type == 1) {
            // Admin: fetch all transactions
            $transactions = Transaction::orderBy('created_at', 'desc')->paginate(5);
        } else {
            // User: fetch only their own transactions
            $transactions = Transaction::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('transactions.index', compact('transactions'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
