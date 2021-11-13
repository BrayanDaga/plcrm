<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleCollection;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $payments = $user->paymentsSponsor()->with('user','courses')->whereHas('courses')->get();
        // return $payments;
        return SaleCollection::make($payments);

    }
}
