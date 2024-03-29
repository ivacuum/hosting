<?php

namespace App;

use App\Observers\ArtistObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
#[ObservedBy(ArtistObserver::class)]
class Artist extends Model
{
    // Relations
    public function gigs()
    {
        return $this->hasMany(Gig::class)
            ->orderByDesc('date');
    }

    public function breadcrumb(): string
    {
        return $this->title;
    }
}
