<?php

namespace App\Domain\SocialMedia\Models;

use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\Observers\SocialMediaPostObserver;
use App\Photo;
use App\User;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $photo_id
 * @property string $caption
 * @property SocialMediaPostStatus $status
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Carbon\CarbonImmutable $published_at
 * @property \Carbon\CarbonImmutable $excluded_at
 * @property Photo $photo
 * @property User $user
 *
 * @mixin \Eloquent
 */
#[ObservedBy(SocialMediaPostObserver::class)]
class SocialMediaPost extends Model
{
    // Relations
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function breadcrumb(): string
    {
        return "#{$this->id}";
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'status' => SocialMediaPostStatus::class,
            'excluded_at' => 'datetime',
            'published_at' => 'datetime',
        ];
    }
}
