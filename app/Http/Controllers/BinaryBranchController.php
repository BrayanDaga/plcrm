<?php

namespace App\Http\Controllers;

use App\Models\user_membreship;
use App\Models\UserMembreship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BinaryBranchController extends Controller
{
    public function binary_branch()
    {
        return view('content.binary_branch');
    }


    // Metodo para listar los usuarios
    public function getListUsersMembreship(): JsonResponse
    {
        $list_user_membreship = UserMembreship::all();
        return response()->json($list_user_membreship);
    }
}