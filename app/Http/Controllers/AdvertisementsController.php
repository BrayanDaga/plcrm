<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdvertisementsController extends Controller
{
    public function index()
    {
        return view('content.config.advertisement');
    }

    public function Add(Request $request)
    {
        $message = new Advertisement();
        $message->content = $request->content;
        $message->status = '0';

        $result = new AdvertisementResource($message);

        if ($message->save()) :
            return ($result)->response()->setStatusCode(200);
        endif;

        return $result->response()->setStatusCode(400);
    }

    public function Edit(Request $request, $id)
    {
        $message = Advertisement::findOrFail($id);
        $result = new AdvertisementResource($message);

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
        $message = Advertisement::findOrFail($id);
        $result = new AdvertisementResource($message);

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
        $messages = Advertisement::paginate(10);
        return AdvertisementResource::collection($messages);
    }

    public function Detail($id)
    {
        $message = Advertisement::findOrFail($id);
        $result = new AdvertisementResource($message);

        if ($message == null) {
            return ($result)->response()->setStatusCode(404);
        }
        return ($result)->response()->setStatusCode(200);
    }
}
