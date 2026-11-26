<?php

namespace App\Models;

use Database\Factories\ArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    /** @use HasFactory<ArticleFactory> */
    use HasFactory;

    use InteractsWithMedia;
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::saving(function ($article) {
            if ($article->slug === null) {
                $article->slug = $this->slugify();
            }
        });

        static::saved(function () {
            cache()->forget('popular_articles');
            cache()->forget('recent_articles');
            cache()->forget('popular_authors');
        });

        static::deleted(function () {
            cache()->forget('popular_articles');
            cache()->forget('recent_articles');
            cache()->forget('popular_authors');
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

    private function slugify(): string
    {
        // Todo: improve this function to avoid duplate slugs, and maybe other isssues.
        return str($this->title)->slug('-');
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
