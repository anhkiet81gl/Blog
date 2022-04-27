<?php

namespace App\Http\Resources\PostCategories;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCategoriesResource extends JsonResource
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
