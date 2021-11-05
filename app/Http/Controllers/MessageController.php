<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use App\Traits\ResponseFormat;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    use ResponseFormat;
    public function show($email){
        $idUser = auth()->user()->id;
        if($idUser2 = User::where('email',$email)->first()){
            $idUser2 = $idUser2->id;
            $data = Message::select('users.name','messages.text','messages.created_at')
                       ->join('users','users.id','=','messages.id_user_transmitter')
                       ->where([
                           ['messages.id_user_transmitter','=',$idUser],
                           ['messages.id_user_receiver','=',$idUser2]
                       ])
                       ->orWhere([
                        ['messages.id_user_transmitter','=',$idUser2],
                        ['messages.id_user_receiver','=',$idUser]
                       ])
                       ->orderBy('messages.created_at','ASC')
                       ->get();
            if(isset($data[0])){
                return $this->responseOk('',$data);
            }else{
                return ["error"=>"no existe conversación"];
            }
        }else{
            return ["error"=>"no existe conversación"];
        }
    }
}
