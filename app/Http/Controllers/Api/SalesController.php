<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\ResponseFormat;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    use ResponseFormat;

    public function index()
    {
        //La tabla courses_payments no es modelo sino un pivote por ende use querystring
        // $user = User::find(Auth::user()->id);
        // $courses =  $user->courses()->whereHas('payments')->get();

    }

    public function show(Payment $payment)
    {
        $this->authorize($payment);
        $payment =  $payment->with('user.accountType','courses')->whereHas('courses')->get();
        return $this->responseOk('',$payment);
    }
}
