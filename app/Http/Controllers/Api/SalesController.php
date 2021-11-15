<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleCollection;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
 
        $payments = $user->paymentsSponsor()->select('payments.id','amount','payments.created_at','user_id')->with(array('user' => function($query) {
            $query->select('id','name','last_name','email','id_account_type')
            ->with(['accountType' => function($query){
                $query->select('account');
            } ]  );
        },'courses' => function($query){
             $query->select('title');
        }))->whereHas('courses')->orderBy('created_at','DESC')->get();

        //  return $payments;

        return SaleCollection::make($payments);
    }

    public function show(Payment $payment)
    {
        $this->authorize($payment);
        return $payment->with('user.accountType','courses')->whereHas('courses')->get();
    }
}
