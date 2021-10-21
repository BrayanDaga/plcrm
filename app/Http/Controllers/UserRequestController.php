<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Classified;
use App\Models\AccountType;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;
use App\Models\UserMembreship;
use Illuminate\Support\Facades\DB;
use App\Models\UserMembreshipsPoints;
use App\Models\AccountTypePointsMoney;
use App\Http\Resources\UserMembreshipResource;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserRequestController extends Controller
{
    public function index()
    {
        /** @var UserRequest $user_request */
        /** @var User
         * Request = 1 reprenseta que el usuario esta en solicitud de ser aprovado
         */
        $this->isAdmin(auth()->user());

        $all_user_requesting = UserMembreship::with('accountType')
            ->where('request', 1)
            ->get();

        

        return UserMembreshipResource::collection($all_user_requesting);
    }

    protected function isAdmin(UserMembreship $user)
    {
        if ($user->id != 1) {
            throw new HttpException(422, 'Este usuario no es el administrador');
        }
    }

    // get user by id
    public function getUserById($id)
    {
        $data = UserMembreship::with('sponsor')
            ->with('paymentsClient', function ($q) {
                $q->with('paymentMethod');
            })
            ->with('documentType')
            ->where('id', $id)
            ->get();

        return response()->json($data[0]);
    }

    public function updateRequest(Request $request)
    {
        $this->isAdmin(auth()->user());
 
        DB::transaction(function ()  use ($request) {
            $user = UserMembreship::find($request->id);
            $user->request = $request->status;
            $user->save();

            $id = $user->id;
            $fullName = $user->fullName;
            
            $parents = Classified::whereRaw("FIND_IN_SET(id_user_membreship, GET_PARENTCLASSIFIED_NODE(${id}))")->get(); ///Obtengo los padres del usuario
            $atm =  AccountTypePointsMoney::where('account_type_id',$user->id_account_type)->first(); //Obtengo los puntos de determiando tipo de cuenta
           
            $payment = $user->paymentsClient;
            $wallet = Wallet::where('payment_id',$payment->id)->first();            
            $wallet->status = '1';
            $wallet->save();
            
            foreach ($parents as $parent) {
                
                 if($user->id_referrer_sponsor == $parent->id_user_sponsor){ //Registrando sin excepciones si es su padre
                    $left =$parent->status_position_left;
                    $right =$parent->status_position_right;
                    $position = $left > $right ? 0 : 1;
                    UserMembreshipsPoints::create([
                        'id_user_membreship' => $user->id,
                        'id_user_sponsor' => $parent->id_user_sponsor,
                        'points' => $atm->points ,
                        'side' => $position,
                        'reason' => "Binary Team Points, ${fullName} Affiliation"
                     ]);
                    
                }elseif($user->id_referrer_sponsor != $parent->id_user_sponsor){
                    $userTmp = UserMembreship::find($parent->id_user_sponsor);
                    if($userTmp->active && $userTmp->qualified){
                        $left =$parent->status_position_left;
                        $right =$parent->status_position_right;
                        $position = $left > $right ? 0 : 1;
                        UserMembreshipsPoints::create([
                            'id_user_membreship' => $user->id,
                            'id_user_sponsor' => $parent->id_user_sponsor,
                            'points' => $atm->points ,
                            'side' => $position,
                            'reason' => "Binary Team Points, ${fullName} Affiliation"
                         ]);
                    }
                   
                }
            }

            
        });
    }
}
