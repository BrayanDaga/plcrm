<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMembreship;

class BinaryCutController extends Controller
{
    public function index()
    {
        $users = UserMembreship::where('id_account_type','!=', 5)->get()->filter(function ($key) {
            return $key->qualified == true && $key->active == true;
        });
        return view('content.binarycut.index',compact('users'));
    }
}
