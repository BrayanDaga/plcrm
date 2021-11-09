<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseFormat;
use App\Http\Controllers\Controller;

class PropiertiesforUserController extends Controller
{
    use ResponseFormat;

    public function getPropierties()
    {
        $user = User::find(auth()->user()->id);
        $totalPayments = $user->paymentsSponsor()->sum('amount');
        $totalCourses = $user->courses()->count();
        $accountType = $user->accountType->account;
        $totalClients  = User::myClients($user->id)->count();
        
        $data = [
            'totalPayments' => $totalPayments,
            'totalCourses' => $totalCourses,
            'accountType' => $accountType,
            'totalClients' => $totalClients
        ];
        return $this->responseOk('',$data);
    }
}
