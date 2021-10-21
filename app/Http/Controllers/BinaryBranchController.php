<?php

namespace App\Http\Controllers;

use App\Helpers\UserMembershipParams;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class BinaryBranchController extends Controller
{
    public function binary_branch()
    {
        return view('content.binary-branch.index');
    }


    // Metodo para listar los usuarios
    public function getListUsersMembreship(Request $request): JsonResponse
    {
        $pagingParams = new UserMembershipParams();

        if ($request->pageSize) {
            $pagingParams->setPageSize($request->pageSize);
        }
        if ($request->order) {
            $pagingParams->setOrderBy($request->order);
        }

        $list_user_membreship = User::with(['country','accountType','documentType'])
            ->join('classified', 'users.id', '=', 'classified.id_user_membreship')
            ->orderBy('users.' . $pagingParams->OrderBy, 'asc')
            ->paginate($pagingParams->PageSize);

        $data_pagination = [
            'pagination' => [
                'total' => $list_user_membreship->total(),
                'current_page' => $list_user_membreship->currentPage(),
                'per_page' => $list_user_membreship->perPage(),
                'last_page' => $list_user_membreship->lastPage(),
                'from' => $list_user_membreship->firstItem(),
                'to' => $list_user_membreship->lastPage(),
            ],
            'result' => $list_user_membreship
        ];

        return response()->json($data_pagination);
    }
}