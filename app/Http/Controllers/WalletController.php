<?php

namespace App\Http\Controllers;

use App\Http\Resources\WalletResource;
use App\Models\Wallet;
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
        $wallets = Wallet::all();
        $wallets =  WalletResource::collection($wallets);
        return $wallets;
    }

    public function retornarVista()
    {
        return view('content.reports.wallet');
    }
}
