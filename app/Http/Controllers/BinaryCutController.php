<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BinaryCutController extends Controller
{
    public function index()
    {
        $users = User::qualifiedsAndActive();
        // return $users;
        return view('content.binarycut.index',compact('users'));
    }

    public function store()
    {
        $users = User::qualifiedsAndActive();
        foreach ($users as $user) {

            $maxPoints = 0;
            $minPoints = 0;
            if($user->LeftPoints > $user->RightPoints){
                $maxPoints = $user->LeftPoints;
                $minPoints = $user->RightPoints;
            }else{
                $maxPoints = $user->RightPoints;
                $minPoints = $user->LeftPoints;
            }
            $sideMax = $user->LeftPoints > $user->RightPoints ? 0 : 1;
            
            $user->points()->where('status',1)->update(['status' => 0]);
            $user->points()->create([
                    'user_id' => $user->id,
                    'points' => $maxPoints - $minPoints,
                    'side' => $sideMax,
                    'reason' => "Binary cut "
            ]);
            $valorDePunto = 1;
            $user->wallets()->create([
                'amount' => $minPoints * $user->accountType->pay_in_binary / 100  * $valorDePunto ,
                'reason' => 'Pay Binary Cut',
                'status' => 1
            ]);
        }
        return redirect()->route('binarycut.index')->withSuccess('Binary cut successfully'); 
    }

}
