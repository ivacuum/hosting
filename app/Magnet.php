<?php namespace App;

use App\Action\FindRelatedMagnetsAction;
use App\Action\FindTagsInMagnetTitleAction;
use App\Action\FormatMagnetDateAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property int $id
 * @property int $user_id
 * @property Domain\MagnetCategory $category_id
 * @property int $rto_id
 * @property string $title
 * @property string $html
 * @property string $related_query
 * @property int $size
 * @property string $info_hash
 * @property string $announcer
 * @property Domain\MagnetStatus $status
 * @property int $clicks
 * @property int $views
 * @property \Carbon\CarbonImmutable $registered_at
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property \Illuminate\Database\Eloquent\Collection|Comment[] $commentsPublished
 * @property \App\User $user
 *
 * @mixin \Eloquent
 */
class Magnet extends Model
{
    use Searchable;

    protected $table = 'torrents';

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

    protected $casts = [
        'size' => 'int',
        'views' => 'int',
        'clicks' => 'int',
        'rto_id' => 'int',
        'status' => Domain\MagnetStatus::class,
        'user_id' => 'int',
        'category_id' => Domain\MagnetCategory::class,
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
        return $this->comments()->where('status', Domain\CommentStatus::Published);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished(Builder $query)
    {
        return $query->where('status', Domain\MagnetStatus::Published);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->shortTitle();
    }

    public function canBeCommented(): bool
    {
        return $this->status === Domain\MagnetStatus::Published;
    }

    public function externalLink(): string
    {
        return "https://rutracker.org/forum/viewtopic.php?t={$this->rto_id}";
    }

    public static function externalSearchLink(string $query): string
    {
        return "https://rutracker.org/forum/tracker.php?nm=" . rawurlencode($query);
    }

    public function fullDate(): string
    {
        return resolve(FormatMagnetDateAction::class)
            ->execute($this->registered_at);
    }

    public function incrementClicks(): void
    {
        $this->timestamps = false;
        $this->increment('clicks');
        $this->timestamps = true;

        event(new \App\Events\Stats\TorrentMagnetClicked);
    }

    public function isAnonymous(): bool
    {
        return $this->user_id === config('cfg.torrent_anonymous_releaser');
    }

    public function magnet(): string
    {
        return "magnet:?xt=urn:btih:{$this->info_hash}&tr=" . urlencode($this->announcer) . "&dn=" . rawurlencode(\Str::limit($this->title, 100, ''));
    }

    public function relatedIds(): array
    {
        return resolve(FindRelatedMagnetsAction::class)
            ->execute($this);
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
        return 'vac_torrents_v1';
    }

    // Заголовок без скобок
    public function shortTitle(): string
    {
        return str_replace('  ', ' ', preg_replace('/\([^)]+\)|\[[^\]]+\]/', '', $this->title));
    }

    public function shouldBeSearchable()
    {
        return $this->status === Domain\MagnetStatus::Published;
    }

    public function titleTags(): array
    {
        return resolve(FindTagsInMagnetTitleAction::class)
            ->execute($this->title);
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'text' => strip_tags($this->html),
            'title' => $this->title,
            'category_id' => $this->category_id->value,
        ];
    }

    public function www(?string $anchor = null): string
    {
        return path([Http\Controllers\MagnetsController::class, 'show'], $this->id) . $anchor;
    }

    public function wwwAcp(): string
    {
        return path([Http\Controllers\Acp\Magnets::class, 'show'], $this);
    }
}