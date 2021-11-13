<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string) $this->resource->getRouteKey(),
                'payments' => [
                    'user' => $this->resource->user->fullName,
                    'courses' => 
                        $this->resource->courses
                ],
            'links' => [
                'self' => route('api.saleshistory.show', $this->resource)
            ]
        ];
    }
}
