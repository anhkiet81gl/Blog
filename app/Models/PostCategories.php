<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url_key',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, PostCategory::class, 'post_category_id', 'post_id',);
    }

}
