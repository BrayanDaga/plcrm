<?php

namespace App\Http\Controllers;

use App\Models\Classified;
use Illuminate\Http\Request;
use App\Models\UserMembreship;
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
    public function index($id)
    {
        // $userMembreships =  Classified::where('id_user_sponsor', )->with('userMembreship')->get();

        // return  $userMembreships;   
        $left = [];
        $right = [];
        $Ramaleft = [];
        $Ramaright = [];
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
        $userValidates = ['user' => ['name' => auth()->user()->fullName], 'lef' => $Ramaleft, 'rigth' => $Ramaright];
        return response()->json($userValidates);
    }

    public function listbinary()
    {
        $data = [];
        $currentUser = auth()->user(); //Obtengo el usuario actual

        // $userMembreships = UserMembreship::where('id_referrer_sponsor', $currentUser->id)->with(["classified" => function ($q) {
        //     $q->where('classified.status_position_left', '=', 1);
        // }])->get()->filter(function($key){
        //   return $key->qualified == true ?? false;
        // })->first(); 
        // return $userMembreships;

        $data[] = $currentUser;
        //1ra Generacion 
        // return $primeraGeneracion[1];
        $primeraGeneracion = $this->findTwoChild($currentUser);

        //Segunda Generacion
        if(!empty($primeraGeneracion)  && count($primeraGeneracion) > 0){
            $data = array_merge($data,$primeraGeneracion);
            if(!empty($primeraGeneracion[0]) ){
                $segundaGen1  = $this->findTwoChild($primeraGeneracion[0]->UserMembreship);
                $data = array_merge($data,$segundaGen1);
            }
            if(!empty($primeraGeneracion[1])){
                $segundaGen2  = $this->findTwoChild($primeraGeneracion[1]->UserMembreship);
                $data = array_merge($data,$segundaGen2);

            }
            // $segundaGeneracion = [$segundaGen1,$segundaGen2];
             

        }
        // $segundaGen2= $this->findTwoChild($primeraGeneracion[1]);

     
        
        return JsonResource::collection($data);
    }

    private function findTwoChild( $user) : array
    {
       $hijos = [];
        if( Classified::with('userMembreship')->where('id_user_sponsor', $user->id)->where('status_position_left',1)->orWhere('status_position_right',1)->exists()){
            $hijos[]  = Classified::with('userMembreship')->where('id_user_sponsor', $user->id)->where('status_position_left',1)->first();
        

            $hijos[]  = Classified::with('userMembreship')->where('id_user_sponsor', $user->id)->where('status_position_right',1)->first();
        }
        return   $hijos;

    }

    public function viewTree()
    {
        // $currentUser =  UserMembreship::where('id', auth()->user()->id)->select('id', 'name', 'last_name', 'expiration_date')->get();

        // $tmpUsers = UserMembreship::where('id_referrer_sponsor', auth()->user()->id)->where('request',2)->isActive()->select('id', 'id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date')->get();


        // evitando hacer doble consulta
        // $hijos=[];
        // foreach ($tmpUsers as $item) {
        //     $tmUser =  UserMembreship::where('id_referrer_sponsor', $item->id)->select('id', 'id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date')->get();
        //     if ($tmUser->isNotEmpty()) {
        //         $hijos = $tmUser;
        //     }
        // }

        // $nivel1 = $tmpUsers->merge($currentUser);
        // $users = $nivel1->merge($hijos);

        //  $users = $tmpUsers->merge($currentUser);
        $id = auth()->user()->id;



        //usando la funcion creada desde el seeder
        $users = UserMembreship::whereRaw("FIND_IN_SET(id, GET_CHILD_NODE(${id}))")->where('request', 2)->where('id_account_type', '!=', 5)->select('id', 'id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date', 'created_at')->get();

        // (function($claveColeccion) {
        //     //return $claveColeccion->qualified === true;
        //     return $claveColeccion->qualified === true && $claveColeccion->active === true;
        // });


        return UserMembreshipResource::collection($users);

        /*La siguiente linea esta comentada ya que en el registro de usuarios no se especifica la fecha de expiracion
        y por ende los nuevos registros no saldran activo y no los mostrara en el arbol de rama binaria  */
        //  $users = UserMembreship::whereRaw("FIND_IN_SET(id, GET_CHILD_NODE(${id}))")->isActive()->where('request',2)->select('id','id_referrer_sponsor AS pid', 'name', 'last_name', 'expiration_date')->get();  
    }
}
