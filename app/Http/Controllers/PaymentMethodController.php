<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return view('content.config.payment-method');
    }

    public function Add(Request $request)
    {
        $paymentMethod = new PaymentMethod();
        $paymentMethod->name = $request->name;

        $result = new PaymentMethodResource($paymentMethod);

        if ($paymentMethod->save()):
            return ($result)->response()->setStatusCode(200);
        endif;

        return $result->response()->setStatusCode(400);
    }

    public function Edit(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $result = new PaymentMethodResource($paymentMethod);

        if ($paymentMethod == null) {
            return ($result)->response()->setStatusCode(404);
        }

        $paymentMethod->name = $request->name ?? $paymentMethod->name;


        if ($paymentMethod->save()) {
            return ($result)->response()->setStatusCode(200);
        };

        return $result->response()->setStatusCode(400);
    }

    public function Delete($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $result = new PaymentMethodResource($paymentMethod);

        if ($paymentMethod->delete()) {
            return ($result)->response()->setStatusCode(200);
        }

        return $result->response()->setStatusCode(400);
    }

    public function List(Request $request): AnonymousResourceCollection
    {
        $paymentMethods = PaymentMethod::paginate(10);
        return PaymentMethodResource::collection($paymentMethods);
    }

    public function Detail($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $result = new PaymentMethodResource($paymentMethod);

        if ($paymentMethod == null) {
            return ($result)->response()->setStatusCode(404);
        }
        return ($result)->response()->setStatusCode(200);


    }
}
