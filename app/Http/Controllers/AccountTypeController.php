<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;
use App\Http\Requests\AccountTypeRequest;
use App\Http\Resources\AccountTypeResource;

class AccountTypeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountTypes  = AccountType::paginate();
        return AccountTypeResource::collection($accountTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountTypeRequest $request)
    {
        $accountType = new AccountType( $request->validated() );
        $accountType->status = 0;
        $accountType->save();
        return response()->json(['data' => $accountType]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function show(AccountType $accountType)
    {
        $accountType = new AccountTypeResource($accountType);
        return $accountType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function update(AccountTypeRequest $request, AccountType $accountType)
    {
        $accountType->fill($request->validated());
        $accountType->update();
        $accountType = new AccountTypeResource($accountType);
        return $accountType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountType  $accountType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,AccountType $accountType)
    {
        $result = new AccountTypeResource($accountType);
        $accountType->status = $request->status ?? $accountType->status;
        $accountType->save();
        if ($accountType->save()) {
            return ($result)->response()->setStatusCode(200);
        }
        return $result->response()->setStatusCode(400);
    }
    public function getDataBytId($id)
    {
        $data = AccountType::find($id);
        return response()->json($data);
    }
}
