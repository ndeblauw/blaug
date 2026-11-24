<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    use InteractsWithMedia;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saved(function () {
            cache()->forget('popular_articles');
            cache()->forget('recent_articles');
        });

        static::deleted(function () {
            cache()->forget('popular_articles');
            cache()->forget('recent_articles');
        });
    }

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

    public function visibleCommentsFor($user)
    {
        return $this->comments()
            ->with(['user', 'article'])
            ->get()
            ->filter(fn (Comment $comment) => $comment->canView($user));
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
        if ($user->is_admin) {
            return true;
        }

        if ($this->author_id == $user->id) {
            return true;
        }

        return false;
    }

    public function getImagePath(string $conversion = 'card'): string
    {
        $media = $this->getFirstMedia('headers');

        if (! $media) {
            return '/img/default-article.png';
        }

        return $media->getAvailableUrl([$conversion, 'card', 'thumbnail']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('card')
            ->fit(Fit::Crop, 800, 600)
            ->nonQueued();

        $this
            ->addMediaConversion('hero')
            ->fit(Fit::Crop, 1600, 900)
            ->nonQueued();
    }
}
