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
}
