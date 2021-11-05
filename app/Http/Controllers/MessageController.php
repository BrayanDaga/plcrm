<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use App\Traits\ResponseFormat;
use Illuminate\Support\Str;

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
        $data = Message::where('receiver_id',auth()->user()->id)
                       ->orderBy('created_at','DESC')
                       ->get();
        if($data){
            $k = array();
            $messages = [];
            $cont = 0;
            foreach($data as $msg){
                if(!$k){
                    array_push($k,$msg->transmitter_id);
                    $messages[] = $this->MessageJson($msg,User::find($msg->transmitter_id));
                    $cont++;
                    continue;
                }else if(in_array($msg->transmitter_id,$k)){
                    continue;
                }else{
                    if($cont >= 5){
                        break;
                    }else{
                        array_push($k,$msg->transmitter_id);
                        $messages[] = $this->MessageJson($msg,User::find($msg->transmitter_id));
                        $cont++;
                    }
                }
            }
            return $this->responseOk('',$messages);
        }else{
            return ['error'=>"No conversations"];
        }
    }
    public function MessageJson($msg,$user){
        return array(
            'user'=> $user->name,
            'email' => $user->email,
            'message' => Str::limit($msg->message,20,'...'),
            'created_at' => $msg->created_at
        );
    }
}
