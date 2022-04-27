<?php

namespace App\Http\Resources\PostAuthors;

use Illuminate\Http\Resources\Json\JsonResource;

class PostAuthorsResource extends JsonResource
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
            'name' => $this->name,
            'url_key' => $this->url_key,
        ];
    }
}
