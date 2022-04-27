<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    public $fillable = [
        'name',
        'url_key'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, PostAuthor::class, 'post_author_id', 'post_id');
    }
}
