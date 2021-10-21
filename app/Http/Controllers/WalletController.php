<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMembreship;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTotalWalletUsers()
    {
        $wallets = Wallet::groupBy('id_user_membreship')
        ->selectRaw('sum(AMOUNT) as available, id_user_membreship')->where('status',1)->with('userMembreship')->get();
        return JsonResource::collection($wallets);
    }

    public function getWalletForUser($username)
    {
        $user = UserMembreship::where('user',$username)->first();
        $wallets = $user->wallets->where('status',1);
        return JsonResource::collection($wallets);
    }
}
