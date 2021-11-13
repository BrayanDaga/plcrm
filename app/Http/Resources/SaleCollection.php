<?php

namespace App\Http\Resources;

use App\Http\Resources\SaleResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SaleCollection extends ResourceCollection
{
    public $collects = SaleResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'links' => [
                'self' => route('api.saleshistory.index')
            ],
            'data' => $this->collection,
        ];  
    }
}
