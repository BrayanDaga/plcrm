<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMembreship;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = Wallet::groupBy('id_user_membreship')
        ->selectRaw('sum(AMOUNT) as sum, id_user_membreship')->with('userMembreship')->get();

        return view('content.reports.wallet',compact('wallets'));
    }
}
