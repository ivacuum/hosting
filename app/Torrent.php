<?php namespace App;

use App\Http\Controllers\Torrents;
use Carbon\CarbonInterval;
use Foolz\SphinxQL\SphinxQL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ivacuum\Generic\Traits\SoftDeleteTrait;
use Laravel\Scout\Searchable;

/**
 * Торрент
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $rto_id
 * @property string $title
 * @property string $html
 * @property string $related_query
 * @property int $size
 * @property string $info_hash
 * @property string $announcer
 * @property int $status
 * @property int $clicks
 * @property int $views
 * @property \Illuminate\Support\Carbon $registered_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property \Illuminate\Database\Eloquent\Collection|\App\Comment[] $commentsPublished
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
class Torrent extends Model
{
    use Searchable, SoftDeleteTrait;

    const SEARCH_INDEX = 'vac_torrents_v1';

    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DELETED = 2;

    const RTO_STATUS_0 = 1; // не проверено
    const RTO_STATUS_1 = 1; // закрыто
    const RTO_STATUS_OK = 2; // проверено
    const RTO_STATUS_3 = 3; // недооформлено
    const RTO_STATUS_4 = 4; // не оформлено
    const RTO_STATUS_DUPLICATE = 5; // повтор
    const RTO_STATUS_6 = 6; // закрыто правообладателем
    const RTO_STATUS_7 = 7; // поглощено
    const RTO_STATUS_8 = 8; // сомнительно
    const RTO_STATUS_9 = 9; // проверяется
    const RTO_STATUS_10 = 10; // временная
    const RTO_STATUS_PREMODERATION = 11; // премодерация

    const LIST_COLUMNS = [
        'id',
        'category_id',
        'rto_id',
        'title',
        'size',
        'info_hash',
        'announcer',
        'clicks',
        'views',
        'registered_at',
    ];

    const TITLE_REPLACE_FROM = [' )', ' ,', 'HD (1080p)'];
    const TITLE_REPLACE_TO = [')', ',', 'HD 1080p'];

    protected $casts = [
        'size' => 'int',
        'views' => 'int',
        'clicks' => 'int',
        'rto_id' => 'int',
        'status' => 'int',
        'user_id' => 'int',
        'category_id' => 'int',
    ];

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
        return $query->where('status', static::STATUS_PUBLISHED);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->shortTitle();
    }

    public function externalLink(): string
    {
        return "https://rutracker.nl/forum/viewtopic.php?t={$this->rto_id}";
    }

    public function fullDate(): string
    {
        $format = $this->registered_at->year == date('Y') ? '%e %B' : '%e %B %Y';

        if ($this->registered_at->isToday()) {
            return trans('torrents.today') . ", " . $this->registered_at->formatLocalized($format);
        } elseif ($this->registered_at->isYesterday()) {
            return trans('torrents.yesterday') . ", " . $this->registered_at->formatLocalized($format);
        }

        return $this->registered_at->formatLocalized($format);
    }

    public function incrementClicks(): void
    {
        $this->timestamps = false;
        $this->increment('clicks');
        $this->timestamps = true;

        event(new \App\Events\Stats\TorrentMagnetClicked);
    }

    public function magnet(): string
    {
        return "magnet:?xt=urn:btih:{$this->info_hash}&tr=" . urlencode($this->announcer) . "&dn=" . rawurlencode(\Str::limit($this->title, 100, ''));
    }

    public function relatedIds(): array
    {
        if (!$this->related_query) {
            return [];
        }

        return array_filter(\Arr::pluck($this->search($this->related_query, function (SphinxQL $builder) {
            return $builder->match('title', $this->related_query, true)
                ->execute();
        })->raw(), 'id'), function ($item) {
            return intval($item) !== $this->id;
        });
    }

    public function relatedTorrents()
    {
        if (!sizeof($ids = $this->relatedIds())) {
            return collect();
        }

        return $this->whereIn('id', $ids)
            ->published()
            ->get(static::LIST_COLUMNS);
    }

    public function searchableAs()
    {
        return static::SEARCH_INDEX;
    }

    // Заголовок без скобок
    public function shortTitle(): string
    {
        return str_replace('  ', ' ', preg_replace('/\([^)]+\)|\[[^\]]+\]/', '', $this->title));
    }

    public function shouldBeSearchable()
    {
        return $this->status === static::STATUS_PUBLISHED;
    }

    public function titleTags(): array
    {
        if (preg_match_all('/биография|
            боевик|
            вестерн|
            военный|
            детектив|
            драма|
            история|
            киберпанк|
            комедия|
            криминал|
            мелодрама|
            музыка|
            мюзикл|
            приключения|
            семейный|
            спорт|
            триллер|
            ужасы|
            фантастика|
            фэнтези|
            юмор|
            
            # Страны
            австралия|
            великобритания|
            германия|
            канада|
            китай|
            испания|
            индия|
            ирландия|
            италия|
            россия|
            сша|
            франция|
            япония|
            
            # Режиссеры
            дэвид\ финчер|
            гай\ ричи|
            кристофер\ нолан|
            ридли\ скотт|
            стивен\ спилберг|
            19\d{2}|
            20\d{2}/iux', $this->title, $matches)) {
            return $matches[0];
        }

        return [];
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'text' => strip_tags($this->html),
            'title' => $this->title,
            'category_id' => $this->category_id,
        ];
    }

    public function www(?string $anchor = null): string
    {
        return path([Torrents::class, 'show'], $this->id) . $anchor;
    }

    // Static methods
    public static function statsByCategories()
    {
        return \Cache::remember(CacheKey::TORRENTS_STATS_BY_CATEGORIES, CarbonInterval::minutes(15), function () {
            return static::selectRaw('category_id, COUNT(*) AS total')
                ->where('status', static::STATUS_PUBLISHED)
                ->groupBy('category_id')
                ->get()
                ->pluck('total', 'category_id');
        });
    }
}
