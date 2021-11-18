<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\ResponseFormat;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    use ResponseFormat;

    public function index()
    {
        //La tabla courses_payments no es modelo sino un pivote por ende use querystring
        $payments= DB::table('courses_payments as cp')
        ->join('payments as p', 'payment_id', '=', 'p.id')
        ->join('courses as c', 'course_id', '=', 'c.id')
        ->join('users as u', 'p.user_id', '=', 'u.id')
        ->join('account_type as a', 'u.id_account_type', '=', 'a.id')
        ->select('p.id as payment_id','p.amount','p.user_id as client','u.name as client_name','u.last_name as client_last_name','c.title as course','c.user_id','cp.price','cp.desc','a.account as client_account','u.photo','p.created_at')
        ->where('c.user_id',auth()->user()->id)
        ->orderBy('p.created_at','desc')
        ->get();
         return $this->responseOk('',$payments);

    }

    public function show(Payment $payment)
    {
        // $this->authorize($payment);
        $payment =  $payment->with('user.accountType','courses')->whereHas('courses')->get();
        return $this->responseOk('',$payment);
    }
}
