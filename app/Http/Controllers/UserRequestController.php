<?php

namespace App\Http\Controllers;

use App\Models\UserMembreship;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function index()
    {
        /** @var UserRequest $user_request */
        /** @var User
         * Request = 1 reprenseta que el usuario esta en solicitud de ser aprovado
         */
        $all_user_requesting = UserMembreship::where('id','<>', 1)->with('accountType')
            ->where('request', '<>', 0)
            ->get();
        
        return view('content.config.user_request', [
            'all_user_requesting' => $all_user_requesting
        ]);
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
        $table = UserMembreship::find($request->id);
        $table->request = $request->status;
        if($table->save()):
            $json = ['response' => 200];
        else:
            $json = ['response' => 500];
        endif;
        return response()->json($json);        
    }
}
