<?php namespace App;

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
    protected $guarded = ['created_at', 'updated_at'];
    protected $perPage = 50;

    protected $casts = [
        'year' => 'int',
        'kp_id' => 'int',
        'is_tv_series' => 'bool',
    ];

    // Methods
    public function breadcrumb(): string
    {
        return $this->title_ru;
    }
}
