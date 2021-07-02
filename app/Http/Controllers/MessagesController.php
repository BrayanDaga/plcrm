<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MessagesController extends Controller
{
    public function index()
    {
        return view('content.config.message');
    }

    public function Add(Request $request)
    {
        $message = new Message();
        $message->content = $request->content;
        $message->status = '0';

        $result = new MessageResource($message);

        if ($message->save()):
            return ($result)->response()->setStatusCode(200);
        endif;

        return $result->response()->setStatusCode(400);
    }

    public function Edit(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $result = new MessageResource($message);

        if ($message == null) {
            return ($result)->response()->setStatusCode(404);
        }

        $message->content = $request->content ?? $message->content;


        if ($message->save()) {
            return ($result)->response()->setStatusCode(200);
        };

        return $result->response()->setStatusCode(400);
    }

    public function Delete(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $result = new MessageResource($message);
    
        if ($message == null) {
            return ($result)->response()->setStatusCode(404);
        }

        $message->status = $request->status ?? $message->status;

        if ($message->save()) {
            return ($result)->response()->setStatusCode(200);
        }

        return $result->response()->setStatusCode(400);
    }

    public function List(Request $request): AnonymousResourceCollection
    {
        $messages = Message::paginate(10);
        return MessageResource::collection($messages);
    }

    public function Detail($id)
    {
        $message = Message::findOrFail($id);
        $result = new MessageResource($message);

        if ($message == null) {
            return ($result)->response()->setStatusCode(404);
        }
        return ($result)->response()->setStatusCode(200);


    }
}
