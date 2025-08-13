<?php

namespace App\Domain\Game\Models;

use App\Domain\Steam\SteamCountryCode;
use App\Domain\Steam\SteamLanguage;
use App\Observers\GameObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $steam_id
 * @property string $title
 * @property string $slug
 * @property string $short_description_en
 * @property string $short_description_ru
 * @property \Carbon\CarbonImmutable $released_at
 * @property \Carbon\CarbonImmutable $finished_at
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property-read string $short_description
 *
 * @mixin \Eloquent
 */
#[ObservedBy(GameObserver::class)]
class Game extends Model
{
    // Methods
    public function breadcrumb(): string
    {
        return "#{$this->title}";
    }

    public function libraryHero(): string
    {
        return "https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/{$this->steam_id}/library_hero.jpg";
    }

    public function libraryImage(): string
    {
        return "https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/{$this->steam_id}/library_600x900_2x.jpg";
    }

    public static function shortDescriptionField(): string
    {
        return 'short_description_' . \App::getLocale();
    }

    public function steamLink(SteamLanguage $language): string
    {
        if ($language === SteamLanguage::Russian) {
            return "https://store.steampowered.com/app/{$this->steam_id}?cc=" . SteamCountryCode::Kyrgyzstan->value . '&l=' . $language->value;
        }

        return "https://store.steampowered.com/app/{$this->steam_id}";
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'finished_at' => 'datetime',
            'released_at' => 'datetime',
        ];
    }

    protected function shortDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->{static::shortDescriptionField()},
        );
    }
}
