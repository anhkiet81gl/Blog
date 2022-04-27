<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'url_key'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, PostTag::class, 'post_tag_id', 'post_id');
    }
}
