<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BinaryBranchController extends Controller
{
    public function binary_branch()
    {
        return view('content.binary_branch');
    }
}