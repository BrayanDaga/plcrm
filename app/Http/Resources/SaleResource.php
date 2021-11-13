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
            'attributes' => [
                'payments' => [
                    'user' => $this->resource->user->fullName,
                    'courses' => 
                        $this->resource->courses
                    
                ],
                // 'slug' => $this->resource->slug,
                // 'content' => $this->resource->content,
            ],
            'links' => [
                // 'self' => route('api.v1.articles.show', $this->resource)
            ]
        ];
    }
}
