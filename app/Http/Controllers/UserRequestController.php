<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Point;
use App\Models\Wallet;
use App\Models\Classified;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTypePointsMoney;
use Illuminate\Http\Resources\Json\JsonResource;
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

        $all_user_requesting = User::with('accountType')
            ->where('request', 1)
            ->get();

        

        return JsonResource::collection($all_user_requesting);
    }

    protected function isAdmin(User $user)
    {
        if ($user->id != 1) {
            throw new HttpException(422, 'Este usuario no es el administrador');
        }
    }

    // get user by id
    public function getUserById($id)
    {
        $data = User::with('sponsor')
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
            $user = User::find($request->id);
            $user->request = $request->status;
            $user->save();

            $id = $user->id;
            $fullName = $user->fullName;
            
            $parents = Classified::whereRaw("FIND_IN_SET(user_id, GET_PARENTCLASSIFIED_NODE(${id}))")->get(); ///Obtengo los padres del usuario
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
                    Point::create([
                        'user_id' => $user->id,
                        'sponsor_id' => $parent->id_user_sponsor,
                        'points' => $atm->points ,
                        'side' => $position,
                        'reason' => "Binary Team Points, ${fullName} Affiliation"
                     ]);
                    
                }elseif($user->id_referrer_sponsor != $parent->id_user_sponsor){
                    $userTmp = User::find($parent->id_user_sponsor);
                    if($userTmp->active && $userTmp->qualified){
                        $left =$parent->status_position_left;
                        $right =$parent->status_position_right;
                        $position = $left > $right ? 0 : 1;
                        Point::create([
                            'user_id' => $user->id,
                            'sponsor_id' => $parent->id_user_sponsor,
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
