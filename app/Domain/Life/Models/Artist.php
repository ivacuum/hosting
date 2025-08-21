<?php

namespace App\Domain\Life\Models;

use App\Domain\Life\Observer\ArtistObserver;
use App\Domain\Life\Policy\ArtistPolicy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
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
#[UsePolicy(ArtistPolicy::class)]
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
