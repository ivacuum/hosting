<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * DC++ хаб
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property int $port
 * @property int $status
 * @property int $clicks
 * @property \Carbon\CarbonImmutable $queried_at
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 */
class DcppHub extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DELETED = 2;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'port' => 'int',
        'status' => 'int',
        'clicks' => 'int',
    ];

    public function breadcrumb(): string
    {
        return $this->address;
    }

    public function checkConnection(): bool
    {
        $handle = fsockopen($this->address, $this->port);
        $online = false;

        stream_set_timeout($handle, 5);

        if ($handle) {
            if (fgets($handle, 6) === '$Lock') {
                $online = true;
            }
        }

        fclose($handle);

        return $online;
    }

    public function externalLink(): string
    {
        return "dchub://{$this->address}" . ($this->port !== 411 ? ":{$this->port}" : '');
    }

    public function incrementClicks(): void
    {
        $this->timestamps = false;
        $this->increment('clicks');
        $this->timestamps = true;

        event(new \App\Events\Stats\DcppHubClicked);
    }
}
