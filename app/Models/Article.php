<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

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
        if($this->image_path !== null) {
            return "/storage/$this->image_path";
        } else {
            return "/img/default-article.png";
        }
    }

}
