<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\AccountType;
use App\Models\UserMembreship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserMembreshipController extends Controller
{
    public function Register()
    {
        $document_type = DocumentType::select('id', 'document')->get();
        $account_type = AccountType::select('id', 'account')->where('status', '1')->get();
        return view('content.user-membreship.register', [
            'document_type' => $document_type,
            'account_type' => $account_type
        ]);
    }

    public function List()
    {
        return view('content.user-membreship.list');
    }

    public function GetList(Request $request) : JsonResponse
    {
        $pageSize = 5;
        if ($request->pageSize)
        {
            $pageSize = (int)$request->pageSize;
        }

        $list_user_membreship = UserMembreship::query()
            ->with(['country','accountType','documentType'])
            ->join('classified', 'user_membreships.id', '=', 'classified.id_user_membreship')
            ->orderBy('name')
            ->paginate($pageSize);

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
        if ($table->save()) :
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
