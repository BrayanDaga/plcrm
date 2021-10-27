<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BonusController extends Controller
{
    public function index()
    {
        $data = [];
        $user = User::find(auth()->user()->id);
        //obtengo el bono de efectivo rapido
        $fast_cash_bonus =  $user->wallets()->where('status',1)->sum('amount');
        //A medida que van aumentando otros tipos de bonos agregarlos al array asociativo
        $data['fast_cash_bonus'] = $fast_cash_bonus;
        return response()->json(['data' => $data]);
    }
}
