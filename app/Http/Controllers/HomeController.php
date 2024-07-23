<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = Transaction::whereIn('status', [
            'MENUNGGU_KONFIRMASI',
            'DIKONFIRMASI',
            'TERLAMBAT'
        ])->get();

        return view('pages.home', compact('transactions'));
    }
}
