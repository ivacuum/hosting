<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $kp_id
 * @property int $year
 * @property bool $is_tv_series
 * @property string $title_ru
 * @property string $title_en
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
class FavoriteMovie extends Model
{
    protected $perPage = 50;

    // Methods
    public function breadcrumb(): string
    {
        return $this->title_ru;
    }

    public function cover(): string
    {
        return "https://st.kp.yandex.net/images/film_big/{$this->kp_id}.jpg";
    }

    public function externalLink(): string
    {
        return "https://www.kinopoisk.ru/film/{$this->kp_id}/";
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'year' => 'int',
            'kp_id' => 'int',
            'is_tv_series' => 'bool',
        ];
    }
}
