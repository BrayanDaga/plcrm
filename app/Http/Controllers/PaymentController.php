<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends Controller
{
    public function index()
    {
        return view('content.payment.payment');
    }

    public function List(Request $request): AnonymousResourceCollection
    {
        $payments = Payment::query()->with(['paymentMethod','userMembreship'])->get();
        return PaymentResource::collection($payments);
    }

    public function listPendingPayments()
    {
        $payments = Payment::standby()->paymentAuthSponsor()->with(['paymentMethod','userMembreship','products'])->get();
        return PaymentResource::collection($payments);
    }
   public function authorizePayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->authorized = 'passed';
        $payment->save();
    }

    public function pendingPayments()
    {
        return view('content.requests.payments');  
    }
}
