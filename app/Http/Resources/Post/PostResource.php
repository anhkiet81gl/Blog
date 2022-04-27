<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\PostAuthors\PostAuthorsCollection;
use App\Http\Resources\PostCategories\PostCategoriesCollection;
use App\Http\Resources\PostTags\PostTagCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'views' => $this->views,
            'image' => $this->image,
            'body' => $this->body,
            'categories' => new PostCategoriesCollection($this->categories),
            'authors' => new PostAuthorsCollection($this->authors),
            'tags' => new PostTagCollection($this->tags),
        ];
    }
}
