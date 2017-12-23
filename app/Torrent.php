<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ivacuum\Generic\Traits\SoftDeleteTrait;

/**
 * Торрент
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $rto_id
 * @property string  $title
 * @property string  $html
 * @property integer $size
 * @property string  $info_hash
 * @property string  $announcer
 * @property integer $status
 * @property integer $clicks
 * @property integer $views
 * @property \Illuminate\Support\Carbon $registered_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \App\User $user
 *
 * @mixin \Eloquent
 */
class Torrent extends Model
{
    use SoftDeleteTrait;

    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DELETED = 2;

    const RTO_STATUS_0 = 1; // не проверено
    const RTO_STATUS_1 = 1; // закрыто
    const RTO_STATUS_2 = 2; // проверено
    const RTO_STATUS_3 = 3; // недооформлено
    const RTO_STATUS_4 = 4; // не оформлено
    const RTO_STATUS_DUPLICATE = 5; // повтор
    const RTO_STATUS_6 = 6; // закрыто правообладателем
    const RTO_STATUS_7 = 7; // поглощено
    const RTO_STATUS_8 = 8; // сомнительно
    const RTO_STATUS_9 = 9; // проверяется
    const RTO_STATUS_10 = 10; // временная
    const RTO_STATUS_PREMODERATION = 11; // премодерация

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $hidden = ['html'];
    protected $dates = ['registered_at'];
    protected $perPage = 50;

    // Relations
    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function commentsPublished()
    {
        return $this->comments()->where('status', Comment::STATUS_PUBLISHED);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished(Builder $query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->title;
    }

    public function externalLink(): string
    {
        return "https://rutracker.cr/forum/viewtopic.php?t={$this->rto_id}";
    }

    public function fullDate(): string
    {
        $format = $this->registered_at->year == date('Y') ? '%e %B' : '%e %B %Y';

        if ($this->registered_at->isToday()) {
            return trans('torrents.today').", ".$this->registered_at->formatLocalized($format);
        } elseif ($this->registered_at->isYesterday()) {
            return trans('torrents.yesterday').", ".$this->registered_at->formatLocalized($format);
        }

        return $this->registered_at->formatLocalized($format);
    }

    public function magnet(): string
    {
        return "magnet:?xt=urn:btih:{$this->info_hash}&tr=" . urlencode($this->announcer) . "&dn=" . rawurlencode(str_limit($this->title, 100, ''));
    }

    public function www(?string $anchor = null): string
    {
        return path('Torrents@show', $this->id).$anchor;
    }

    // Static methods
    public static function statsByCategories()
    {
        return \Cache::remember(CacheKey::TORRENTS_STATS_BY_CATEGORIES, 15, function () {
            return self::selectRaw('category_id, COUNT(*) as total')
                ->where('status', self::STATUS_PUBLISHED)
                ->groupBy('category_id')
                ->get()
                ->pluck('total', 'category_id');
        });
    }
}
