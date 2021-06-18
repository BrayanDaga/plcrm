<?php

namespace App\Http\Controllers;

use App\Models\UserMembreship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserMembreshipController extends Controller
{
    public function Register()
    {
        return view('content.user-membreship.register');
    }

    public function Create(Request $request)
    {
        $table = new UserMembreship();
        $table->user = $request->user;
        $table->password = Hash::make($request->password);
        $table->name = $request->name;
        $table->last_name = $request->last_name;
        $table->phone = $request->phone;
        $table->date_birth = $request->date_birth;
        $table->email = $request->email;
        $table->referrer_sponsor = $request->referrer_sponsor;
        $table->id_country = $request->id_country;
        $table->id_document_type = $request->id_document_type;
        $table->id_account_type = $request->id_account_type;
        $table->nro_document = $request->nro_document;
        if($table->save()):
            $json = ['status' => 200];
            return json_encode($json);
        endif;
    }

    public function getDataUser($user)
    {
        $data = UserMembreship::where('user', $user)->get();
        return response()->json($data, 200);
    }
}
