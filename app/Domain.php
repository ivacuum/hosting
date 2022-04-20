<?php namespace App;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $alias_id
 * @property int $client_id
 * @property int $yandex_user_id
 * @property string $domain
 * @property int $status
 * @property int $domain_control
 * @property int $orphan
 * @property string $ipv4
 * @property string $ipv6
 * @property string $mx
 * @property string $ns
 * @property string $text
 * @property string $cms_type
 * @property string $cms_version
 * @property string $cms_url
 * @property string $cms_user
 * @property string $cms_pass
 * @property string $ftp_host
 * @property string $ftp_user
 * @property string $ftp_pass
 * @property string $ssh_host
 * @property string $ssh_user
 * @property string $ssh_pass
 * @property string $db_pma
 * @property string $db_host
 * @property string $db_user
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property \Carbon\CarbonImmutable $registered_at
 * @property \Carbon\CarbonImmutable $paid_till
 * @property \Carbon\CarbonImmutable $queried_at
 *
 * @property Domain $alias
 * @property \Illuminate\Database\Eloquent\Collection|Domain[] $aliases
 * @property Client $client
 * @property YandexUser $yandexUser
 *
 * @mixin \Eloquent
 */
class Domain extends Model
{
    protected $guarded = ['created_at', 'updated_at', 'raw', 'goto'];
    protected $hidden = ['cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass'];
    protected $dates = ['mailed_at', 'queried_at', 'registered_at', 'paid_till'];
    protected $perPage = 50;

    protected $casts = [
        'orphan' => 'int',
        'status' => 'int',
        'alias_id' => 'int',
        'client_id' => 'int',
        'domain_control' => 'int',
        'yandex_user_id' => 'int',
    ];

    // Internal
    public function getRouteKeyName()
    {
        return 'domain';
    }

    // Relations
    public function alias()
    {
        return $this->belongsTo(static::class);
    }

    public function aliases()
    {
        return $this->hasMany(static::class, 'alias_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function yandexUser()
    {
        return $this->belongsTo(YandexUser::class);
    }

    // Scopes
    public function scopeYandexReady(Builder $query, int $userId = null)
    {
        $query->where('status', 1)
            ->orderBy('domain');

        return $userId === null
            ? $query->where('yandex_user_id', 0)
            : $query->whereIn('yandex_user_id', [0, $userId]);
    }

    public function scopeWhoisReady(Builder $query)
    {
        return $query->where('status', 1)
            ->where('queried_at', '<', (string) now()->subHours(3));
    }

    // Methods
    public function breadcrumb()
    {
        return $this->domain;
    }

    public function getWhoisData()
    {
        $query = new WhoisQuery($this->domain);

        return $query->getRaw();
    }

    public function getWhoisParsedData()
    {
        $query = new WhoisQuery($this->domain);
        $data = array_merge($query->parse(), $query->getDnsRecords());

        // whois failed
        if (empty($data['registered_at'])) {
            return [];
        }

        $data['registered_at'] = CarbonImmutable::parse($data['registered_at']);
        $data['paid_till'] = CarbonImmutable::parse($data['paid_till']);
        $data['queried_at'] = now();
        $data['raw'] = $query->getRaw();

        return $data;
    }

    public function isExpired(): bool
    {
        return $this->paid_till
            && $this->paid_till->year > 1970
            && ($this->paid_till->isPast() || str_contains($this->ns, 'expired.reg.ru'));
    }

    public function isExpiringSoon(): bool
    {
        return $this->paid_till
            && $this->paid_till->isFuture()
            && $this->paid_till->diffInDays() < 30;
    }

    public function isIdn($domain = ''): bool
    {
        $domain = $domain ?: $this->domain;

        return str_starts_with($domain, 'xn--');
    }

    public function updateWhois()
    {
        if (empty($data = $this->getWhoisParsedData())) {
            return false;
        }

//        if ($this->isExpired()) {
//            unset($data['paid_till']);
//        }

        event(new Events\DomainWhoisUpdated($this, $data));

        $this->update($data);

        return true;
    }

    public function whatServerIpv4()
    {
        return match ($this->ipv4) {
            '62.109.0.61' => 'srv1.korden.net',
            '188.120.229.204' => 'srv2.korden.net',
            '62.109.4.161' => 'srv3.korden.net',
            '62.109.6.149' => 'srv4.korden.net',
            '94.250.254.141' => 'srv5.korden.net',
            '93.81.237.72' => 'srv2.ivacuum.ru',
            '77.221.130.18' => 'srv018.infobox.ru',
            '77.221.130.22' => 'srv022.infobox.ru',
            '77.221.130.25' => 'srv025.infobox.ru',
            '77.221.130.41' => 'srv041.infobox.ru',
            '77.222.56.62' => 'vh213.sweb.ru',
            default => str_replace(' ', '<br>', $this->ipv4),
        };
    }

    public function firstNsServer()
    {
        return explode(' ', $this->ns)[0];
    }
}
