<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classified;
use Illuminate\Support\Facades\DB;
use App\Services\TreeBinaryService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RamaBinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listbinary(TreeBinaryService $treebinary) :AnonymousResourceCollection
    {
        return $treebinary->listbinary();
    }


    public function viewTree() : AnonymousResourceCollection
    {
        $id = auth()->user()->id;
        //usando la funcion creada desde el seeder
        $users = User::whereRaw("FIND_IN_SET(id, GET_CHILD_NODE(${id}))")->where('id_account_type', '!=', 5)->select('id', 'id_referrer_sponsor AS pid', 'name', 'email', 'last_name', 'expiration_date', 'created_at')->get();

        return JsonResource::collection($users);
    }
}
