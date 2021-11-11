<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Str;
use App\Traits\ResponseFormat;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    use ResponseFormat;
    public function show($email){
        $idUser = auth()->user()->id;
        if($idUser2 = User::where('email',$email)->first()){
            $idUser2 = $idUser2->id;
            $data = Message::select('users.name','messages.message','messages.created_at')
                       ->join('users','users.id','=','messages.transmitter_id')
                       ->where([
                           ['messages.transmitter_id','=',$idUser],
                           ['messages.receiver_id','=',$idUser2]
                       ])
                       ->orWhere([
                        ['messages.transmitter_id','=',$idUser2],
                        ['messages.receiver_id','=',$idUser]
                       ])
                       ->orderBy('messages.created_at','ASC')
                       ->get();
            if(isset($data[0])){
                return $this->responseOk('',$data);
            }else{
                return ["error"=>"No conversations"];
            }
        }else{
            return ["error"=>"No conversations"];
        }
    }
    public function list(){
        if($msj = Message::MessageSelect()->MessageOrder()){
            $json = [];
            foreach ($msj as $key => $value) {
                if(count($json) >= 5){
                    break;
                }else{
                    $json[] = $msj[$key]->first();
                }
            }
            return $this->responseOk('',$json);
        }else{
            return ['error' => "no conversations"];
        }
    }
}
