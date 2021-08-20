<?php

namespace App\Http\Controllers;

use App\Models\Classified;
use Illuminate\Http\Request;
use App\Models\UserMembreship;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserMembreshipResource;


class RamaBinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $userMembreships =  Classified::where('id_user_sponsor', )->with('userMembreship')->get();

        // return  $userMembreships;   
        $left = [ ];
        $right = [ ]; 
        $Ramaleft = [ ];
        $Ramaright = [ ]; 
        $userclassifieds = [];
        $userMembreships = Classified::where($id)->get();
        //Voy a buscar los usuarios que tienen registros en las dos ramas ya que esa es la condicion si estan calificados

        foreach ($userMembreships as $item) {
            $left  = Classified::where('id_user_sponsor', $item->id_user_membreship)->where('status_position_left', 1)->distinct()->get();
            $rigth  = Classified::where('id_user_sponsor', $item->id_user_membreship)->where('status_position_right', 1)->distinct()->get();
             if ($rigth->isNotEmpty() && $left->isNotEmpty()) {
                 $userclassifieds[] = $item;
             }
        }

        // Verificiar si los usuarios calificados estan activos y agrupar las ramas en un array
        foreach ($userclassifieds as $item) {
            if ($item->userMembreship->active == true) {
                if ($item->status_position_left == 1) {
                    $Ramaleft[] = $item->userMembreship->fullName;
                }
                if ($item->status_position_right == 1) {
                    $Ramaright[] = $item->userMembreship->fullName;
                }
            }
        }
        $userValidates = ['user'=> ['name'=>auth()->user()->fullName], 'lef'=>$Ramaleft, 'rigth'=>$Ramaright];
        return response()->json($userValidates);
    }

    public function viewTree()
    {
        $userMembreships =  UserMembreship::all() ;
        return UserMembreshipResource::collection($userMembreships);

    }
}
