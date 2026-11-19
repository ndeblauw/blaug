<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'publish_date' => 'datetime',
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function canManage($user): bool
    {
        if($user->is_admin) {
            return true;
        }

        if ($this->author_id == $user->id) {
            return true;
        }

        return false;
    }

    public function getImagePath()
    {
        if($this->getMedia('headers')->isNotEmpty()) {
            return $this->getMedia('headers')->first()->getUrl();
        } else {
            return "/img/default-article.png";
        }
    }

}
