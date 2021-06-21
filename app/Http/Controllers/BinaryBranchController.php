<?php

namespace App\Http\Controllers;

use App\Models\UserMembreship;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class BinaryBranchController extends Controller
{
    public function binary_branch()
    {
        return view('content.binary-branch.binary_branch');
    }


    // Metodo para listar los usuarios
    public function getListUsersMembreship(Request $request): JsonResponse
    {
        $list_user_membreship = UserMembreship::query()
            ->join('classified','user_membreships.id', '=', 'classified.id_user_membreship')
            ->with(['country', 'accountType', 'documentType'])
            ->orderBy('name')
            ->paginate(5);

        return response()->json([
            'pagination' => [
                'total' => $list_user_membreship->total(),
                'current_page' => $list_user_membreship->currentPage(),
                'per_page' => $list_user_membreship->perPage(),
                'last_page' => $list_user_membreship->lastPage(),
                'from' => $list_user_membreship->firstItem(),
                'to' => $list_user_membreship->lastPage(),
            ],
            'result' => $list_user_membreship
        ]);
    }
}