<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
    ];

    public function getImageAttribute(): ?string
    {
        if (!isset($this->attributes['image'])) {
            return null;
        }

        return route('private.image', [
            'folder' => 'post_images',
            'filename' => $this->attributes['image'],
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
