<?php

namespace App;

use App\Domain\DcppHubStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $address
 * @property int $port
 * @property DcppHubStatus $status
 * @property int $is_online
 * @property int $clicks
 * @property \Carbon\CarbonImmutable $queried_at
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
class DcppHub extends Model
{
    protected $attributes = [
        'port' => 411,
        'status' => DcppHubStatus::Published,
    ];

    public function breadcrumb(): string
    {
        return $this->address;
    }

    public function externalLink(): string
    {
        return "dchub://{$this->address}" . ($this->port !== 411 ? ":{$this->port}" : '');
    }

    public function incrementClicks(): void
    {
        Model::withoutTimestamps(fn () => $this->increment('clicks'));

        event(new Events\Stats\DcppHubClicked);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'port' => 'int',
            'status' => DcppHubStatus::class,
            'clicks' => 'int',
            'queried_at' => 'datetime',
        ];
    }
}
