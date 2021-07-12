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
        $all_user_requesting = UserMembreship::with('accountType')
        ->where('request', 1)
        ->get();

        return view('content.config.user_request',[
            'all_user_requesting' => $all_user_requesting
        ]);
    }

    // get user by id
    public function getUserById($id){
        $data = UserMembreship::find($id);
        return response()->json($data);
    }
}
