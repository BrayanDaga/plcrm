<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\UserMembershipParams;
use App\Models\DocumentType;
use App\Models\AccountType;
use App\Models\Classified;
use App\Models\Country;
use App\Models\UserMembreship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserMembreshipController extends Controller
{
    public function Register($id_referrer_sponsor)
    {
        $sponsor = UserMembreship::find($id_referrer_sponsor);
        $document_type = DocumentType::select('id', 'document')->get();
        $account_type = AccountType::select('id', 'account')->where('status', '1')->get();
        $country = Country::select('id', 'name')->get();
        
        return view('content.user-membreship.register', [
            'document_type' => $document_type,
            'account_type' => $account_type,
            'country' => $country,
            'id_referrer_sponsor' => $sponsor->id,
            'sponsor_name' => $sponsor->name,
        ]);
    }

    public function List()
    {
        return view('content.user-membreship.list');
    }

    public function GetList(Request $request): JsonResponse
    {
        $pagingParams = new UserMembershipParams();

        if ($request->pageSize) {
            $pagingParams->setPageSize($request->pageSize);
        }
        if ($request->order) {
            $pagingParams->setOrderBy($request->order);
        }
        if ($request->send)
        {
            $pagingParams->setSend($request->send);
        }

        $list_user_membreship = UserMembreship::query()
            ->orWhere('name', 'like', '%' . $request->send . '%')
            ->with(['country', 'accountType', 'documentType'])
            ->join('classified', 'user_membreships.id', '=', 'classified.id_user_membreship')
            ->orderBy('user_membreships.' . $pagingParams->OrderBy, 'asc')
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

    public function Create(Request $request)
    {
        // Obtener datos de tipo de cuenta segun el id
        $account_type = AccountType::find($request->id_account_type);
        $price = $account_type->price;
        $iva = $account_type->iva;
        $total_price_iva = ($price  * $iva) + $price;

        // Validacion de tipo de cuenta
        

        $table = new UserMembreship();
        $table->user = $request->user;
        $table->password = Hash::make($request->password);
        $table->name = $request->name;
        $table->last_name = $request->last_name;
        $table->phone = $request->phone;
        $table->date_birth = $request->date_birth;
        $table->email = $request->email;
        $table->id_referrer_sponsor = $request->id_referrer_sponsor;
        $table->id_country = $request->id_country;
        $table->id_document_type = $request->id_document_type;
        $table->id_account_type = $request->id_account_type;
        $table->nro_document = $request->nro_document;
        
        if ($table->save()):
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
