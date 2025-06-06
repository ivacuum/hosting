<?php

namespace App;

use App\Action\FindRelatedMagnetsAction;
use App\Action\FindTagsInMagnetTitleAction;
use App\Action\FormatMagnetDateAction;
use App\Domain\CommentStatus;
use App\Domain\Config;
use App\Domain\MagnetCategory;
use App\Domain\MagnetStatus;
use App\Observers\MagnetObserver;
use App\Scope\MagnetPublishedScope;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

/**
 * @property int $id
 * @property int $user_id
 * @property MagnetCategory $category_id
 * @property int $rto_id
 * @property string $title
 * @property string $html
 * @property string $related_query
 * @property int $size
 * @property string $info_hash
 * @property string $announcer
 * @property MagnetStatus $status
 * @property int $clicks
 * @property int $views
 * @property \Carbon\CarbonImmutable $registered_at
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $commentsPublished
 * @property \App\User $user
 * @property-read int $comments_count
 *
 * @mixin \Eloquent
 */
#[ObservedBy(MagnetObserver::class)]
class Magnet extends Model
{
    use Notifiable;
    use Searchable;

    public const array LIST_COLUMNS = [
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

    protected $hidden = ['html'];

    // Relations
    public function comments()
    {
        return $this->morphMany(Comment::class, 'rel');
    }

    public function commentsPublished()
    {
        return $this->comments()->where('status', CommentStatus::Published);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Methods
    public function breadcrumb(): string
    {
        return $this->shortTitle();
    }

    public function canBeCommented(): bool
    {
        return $this->status === MagnetStatus::Published;
    }

    public function externalLink(): string
    {
        return "https://rutracker.org/forum/viewtopic.php?t={$this->rto_id}";
    }

    public static function externalSearchLink(string $query): string
    {
        return 'https://rutracker.org/forum/tracker.php?nm=' . rawurlencode($query);
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
        return $this->user_id === Config::MagnetAnonymousReleaser->get();
    }

    public function magnet(): string
    {
        return "magnet:?xt=urn:btih:{$this->info_hash}&tr=" . urlencode($this->announcer) . '&dn=' . rawurlencode(\Str::limit($this->title, 100, ''));
    }

    public function relatedIds(): array
    {
        return resolve(FindRelatedMagnetsAction::class)
            ->execute($this);
    }

    public function relatedTorrents()
    {
        if (!count($ids = $this->relatedIds())) {
            return collect();
        }

        return $this->whereIn('id', $ids)
            ->tap(new MagnetPublishedScope)
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
        return $this->status->isPublished();
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

    public function www(string|null $anchor = null): string
    {
        return to('magnets/{magnet}', $this->id) . $anchor;
    }

    public function wwwAcp(): string
    {
        return to('acp/magnets/{magnet}', $this->id);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'size' => 'int',
            'views' => 'int',
            'clicks' => 'int',
            'rto_id' => 'int',
            'status' => MagnetStatus::class,
            'user_id' => 'int',
            'category_id' => MagnetCategory::class,
            'registered_at' => 'datetime',
        ];
    }
}
