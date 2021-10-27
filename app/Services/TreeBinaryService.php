<?php namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classified;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TreeBinaryService 
{
    public function listbinary() :AnonymousResourceCollection
    {
        $data = [];
        $currentUser =   User::find(auth()->user()->id); //Obtengo el usuario actual

        $data['c'] = $currentUser;  //Agregamos el usuario actual

        $A = $this->findChildLeft($currentUser); //Primer hijo izquierdo llamado A
        $B = $this->findChildRight($currentUser); //Primer hijo derecho llamado B
        if (!empty($A)) {
            $data['a'] = $A;
            $Aa = $this->findChildLeft($A->user); //Hijo izquierdo de A llamado Aa
            $Ab = $this->findChildRight($A->user); //Hijo derecho de A llamado Ab

            if (!empty($Aa)) {
                $data['aa'] = $Aa;
            }
            if (!empty($Ab)) {
                $data['ab'] = $Ab;
            }
        }
        if (!empty($B)) {
            $data['b'] = $B;
            $Ba = $this->findChildLeft($B->user); //Hijo izquierdo de B llamado Ba
            $Bb = $this->findChildRight($B->user); //Hijo derecho de B llamada Bb

            if (!empty($Ba)) {
                $data['ba'] = $Ba;
            }
            if (!empty($Bb)) {
                $data['bb'] = $Bb;
            }
        }
        return JsonResource::collection($data);
    }


    private function findChildLeft($user)
    {
        $son = Classified::with('user')->where('id_user_sponsor', $user->id)->where('status_position_left', 1)->first();
        return  $son;
    }

    private function findChildRight($user)
    {
        $son = Classified::with('user')->where('id_user_sponsor', $user->id)->where('status_position_right', 1)->first();
        return  $son;
    }
}