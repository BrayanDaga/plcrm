<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{    
    public function getDataBytId($id)
    {
        $data = AccountType::find($id);
        return response()->json($data);
    }
}
