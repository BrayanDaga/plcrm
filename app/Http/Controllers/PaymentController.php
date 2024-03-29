<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\ResponseFormat;
use App\Models\CancelledPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends Controller 
{
    use ResponseFormat;
    public function index()
    {
        return view('content.payment.payment');
    }

    public function List(Request $request): AnonymousResourceCollection
    {
        $payments = Payment::query()->with(['paymentMethod', 'user'])->get();
        return PaymentResource::collection($payments);
    }

    // list pending Payments of User 
    // public function listUserPendingPayments()
    // {
    //     $payments = Payment::standby()->paymentAuthSponsor()->with(['paymentMethod', 'user.accountType', 'products'])->get();
    //     return PaymentResource::collection($payments);
    // }

    public function listUserPayments()
    {
        $payments = Payment::paymentAuthSponsor()->with(['user.accountType', 'products'])->get();
        return PaymentResource::collection($payments);
    }

    // Autorize Payment
    // public function authorizePayment($id)
    // {
    //     $payment = Payment::findOrFail($id);
    //     $payment->authorized = 'passed';
    //     $payment->save();
    // }

    // Deny Payment
    // public function denyPayment($id, Request $request)
    // {
    //     $payment = Payment::findOrFail($id);
    //     return DB::transaction(function () use ($payment, $request) {
    //         $payment->authorized = 'rejected';
    //         $payment->save();
    //         $payment->cancelledpayment()->create(['justification' => $request->justification]);
    //     }, 5);
    // }

    public function listMyPayments()
    {
        return view('content.requests.payments');
    }



}
