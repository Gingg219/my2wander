<?php

namespace App\Models;

use App\Enums\PublishedEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_posts', 'post_id', 'category_id')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tags', 'post_id', 'tag_id')->withTimestamps();
    }

    protected static function booted()
    {
        static::creating(static function ($user) {
            $user->user_id=auth()->user()->id;
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
        'parent_id',
        'title',
        'content',
        'meta_title',
        'slug',
        'status',
    ];
}
