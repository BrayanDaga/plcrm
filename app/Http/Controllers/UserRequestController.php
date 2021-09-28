<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserMembreshipResource;
use App\Models\AccountType;
use App\Models\AccountTypePointsMoney;
use App\Models\Classified;
use App\Models\UserMembreship;
use App\Models\UserMembreshipsPoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

class UserRequestController extends Controller
{
    public function index()
    {
        /** @var UserRequest $user_request */
        /** @var User
         * Request = 1 reprenseta que el usuario esta en solicitud de ser aprovado
         */
        $all_user_requesting = UserMembreship::with('accountType')
        ->where('id_referrer_sponsor', auth()->user()->id)
            ->where('request', 1)
            ->get();

        return UserMembreshipResource::collection($all_user_requesting);
    }

    // get user by id
    public function getUserById($id)
    {
        $data = UserMembreship::with('sponsor')
            ->with('payments', function ($q) {
                $q->with('paymentMethod');
            })
            ->with('documentType')
            ->where('id', $id)
            ->get();

        return response()->json($data[0]);
    }

    public function updateRequest(Request $request)
    {
        // if($table->save()):
        //     $json = ['response' => 200];
        // else:
        //     $json = ['response' => 500];
        // endif;
        // return response()->json($json);        
        DB::transaction(function ()  use ($request) {
            $table = UserMembreship::find($request->id);
            $table->request = $request->status;
            $table->save();
            if ($request->status == 2) {
                    
                
                    // if (auth()->user()->qualified == 1 ) {
                        if (auth()->user()->qualified == 1  && auth()->user()->active == 1) {
                            $atm =  AccountTypePointsMoney::where('account_type_id',$table->id_account_type)->first();
    
                            // UserMembreshipsPoints::create([
                            //     'id_user_membreship' => $table->id,
                            //     'id_user_sponsor' => auth()->user()->id,
                            //     'points' => $atm->points ,
                            //     'side' => $position
                            // ]);
                        }
    
            }
            
        });
    }
}
