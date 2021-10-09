<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMembreship;

class BinaryCutController extends Controller
{
    public function index()
    {
        $users = $this->qualifiedsAndActive();
        return view('content.binarycut.index',compact('users'));
    }

    public function store()
    {
        $users = $this->qualifiedsAndActive();
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
                    'id_user_membreship' => $user->id,
                    'points' => $maxPoints - $minPoints,
                    'side' => $sideMax,
                    'reason' => "Binary cut "
            ]);
        }
        return redirect()->route('binarycut.index')->withSuccess('Binary cut successfully'); 
    }

    private function qualifiedsAndActive()
    {
        return UserMembreship::where('id_account_type','!=', 5)->get()->filter(function ($key) {
            return $key->qualified == true && $key->active == true;
        });
    }
}
