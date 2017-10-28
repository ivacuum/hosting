<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * DC++ хаб
 *
 * @property integer $id
 * @property string  $title
 * @property string  $address
 * @property integer $port
 * @property integer $status
 * @property integer $clicks
 * @property \Illuminate\Support\Carbon $queried_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class DcppHub extends Model
{
    const STATUS_HIDDEN = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DELETED = 2;

    protected $guarded = ['created_at', 'updated_at'];

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
        return "dchub://{$this->address}".($this->port !== 411 ? ":{$this->port}" : '');
    }
}
