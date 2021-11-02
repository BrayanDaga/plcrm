<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Traits\ResponseFormat;

class MessageController extends Controller
{
    use ResponseFormat;
    public function show($transmitter , $receiver){
        $data = Message::select('users.username','messages.text','messages.created_at')
                       ->join('users','users.id','=','messages.transmitter')
                       ->where([
                           ['messages.transmitter','=',$transmitter],
                           ['messages.receiver','=',$receiver]
                       ])
                       ->orWhere([
                        ['messages.transmitter','=',$receiver],
                        ['messages.receiver','=',$transmitter]
                       ])
                       ->orderBy('messages.created_at','ASC')
                       ->get();
        if(isset($data[0])){
            return $this->responseOk('',$data);
        }else{
            return ["error"=>"no existe conversación"];
        }
    }
}
