<?php

namespace App\Http\Controllers;

use App\Models\UserMembreship;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = UserMembreship::where('id_referrer_sponsor', auth()->user()->id)->with('wallet')->get()->pluck('wallet');
        return view('content.reports.wallet',compact('wallets'));
    }
}
