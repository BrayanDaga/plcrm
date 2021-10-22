<?php

namespace App\Http\Controllers;

use App\Models\Classified;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserMembreshipResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RamaBinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listbinary()
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
        $hijo = Classified::with('user')->where('id_user_sponsor', $user->id)->where('status_position_left', 1)->first();
        return  $hijo;
    }

    private function findChildRight($user)
    {
        $hijo = Classified::with('user')->where('id_user_sponsor', $user->id)->where('status_position_right', 1)->first();
        return  $hijo;
    }

    public function viewTree()
    {
        $id = auth()->user()->id;
        //usando la funcion creada desde el seeder
        $users = User::whereRaw("FIND_IN_SET(id, GET_CHILD_NODE(${id}))")->where('id_account_type', '!=', 5)->select('id', 'id_referrer_sponsor AS pid', 'name', 'email', 'last_name', 'expiration_date', 'created_at')->get();

        return UserMembreshipResource::collection($users);
    }
}
