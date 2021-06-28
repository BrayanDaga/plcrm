<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankResource;
use App\Models\Bank;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BankController extends Controller
{
    public function index()
    {
        return view('content.configurations.bank');
    }

    public function Add(Request $request)
    {
        $bank = new Bank();
        $bank->name = $request->name;

        $result = new BankResource($bank);

        if ($bank->save()):
            return ($result)->response()->setStatusCode(200);
        endif;

        return $result->response()->setStatusCode(400);
    }

    public function Edit(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);
        $result = new BankResource($bank);
/*
        if ($bank) {
            return ($result)->response()->setStatusCode(404);
        }*/

        $bank->name = $request->name ?? $bank->name;


        if ($bank->save()) {
            return ($result)->response()->setStatusCode(200);
        };

        return $result->response()->setStatusCode(400);
    }

    public function Delete($id)
    {
        $bank = Bank::findOrFail($id);
        $result = new BankResource($bank);

        if ($bank->delete()) {
            return ($result)->response()->setStatusCode(200);
        }

        return $result->response()->setStatusCode(400);
    }

    public function List(Request $request): AnonymousResourceCollection
    {
        $banks = Bank::paginate(10);
        return BankResource::collection($banks);
    }

    public function Detail($id)
    {
        $bank = Bank::findOrFail($id);
        $result = new BankResource($bank);

        if ($bank) {
            return ($result)->response()->setStatusCode(404);
        }

        return ($result)->response()->setStatusCode(200);

    }


}
