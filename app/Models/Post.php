<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const status = [
        1 => 'Enabled',
        0 => 'Disabled',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'views',
        'image',
        'body',
        'published',
    ];

    public function postCategories()
    {
        return $this->belongsToMany(PostCategories::class, PostCategory::class, 'post_id', 'post_category_id');
    }

    public function postTags()
    {
        return $this->belongsToMany(Tag::class, PostTag::class, 'post_id', 'post_tag_id');
    }

    public function postAuthors()
    {
        return $this->belongsToMany(Author::class, PostAuthor::class, 'post_id', 'post_author_id');
    }

}
