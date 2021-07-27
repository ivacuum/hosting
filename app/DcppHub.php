<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $address
 * @property int $port
 * @property int $status
 * @property int $is_online
 * @property int $clicks
 * @property \Carbon\CarbonImmutable $queried_at
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 */
class DcppHub extends Model
{
    protected $dates = ['queried_at'];
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

    public function externalLink(): string
    {
        return "dchub://{$this->address}" . ($this->port !== 411 ? ":{$this->port}" : '');
    }

    public function incrementClicks(): void
    {
        $this->timestamps = false;
        $this->increment('clicks');
        $this->timestamps = true;

        event(new Events\Stats\DcppHubClicked);
    }

    public function isConnectionOnline(): bool
    {
        try {
            $handle = fsockopen($this->address, $this->port, $errno, $errstr, 5);
        } catch (\Throwable) {
            return false;
        }

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
}
