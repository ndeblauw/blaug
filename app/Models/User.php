<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, InteractsWithMedia, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            cache()->forget('popular_articles');
            cache()->forget('recent_articles');
            cache()->forget('popular_authors');
            cache()->forget('active_users');
        });

        static::deleted(function () {
            cache()->forget('popular_articles');
            cache()->forget('recent_articles');
            cache()->forget('popular_authors');
            cache()->forget('active_users');
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function getAvatarPath(string $conversion = 'thumb'): string
    {
        $avatar = $this->getFirstMedia('avatars');

        return $avatar !== null
            ? $avatar->getAvailableUrl([$conversion, 'thumb', 'profile'])
            : '/img/default-avatar.svg';
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Fit::Crop, 96, 96)
            ->nonQueued();

        $this
            ->addMediaConversion('profile')
            ->fit(Fit::Crop, 240, 240)
            ->nonQueued();
    }
}
