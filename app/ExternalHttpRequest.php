<?php namespace App;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Domain\ExternalService $service_name
 * @property string $method
 * @property string $scheme
 * @property string $host
 * @property string $path
 * @property string $query
 * @property array $request_headers
 * @property string $request_body
 * @property array $response_headers
 * @property string $response_body
 * @property int $response_size
 * @property int $total_time_us
 * @property int $http_code
 * @property string $http_version
 * @property int $redirect_count
 * @property int $redirect_time_us
 * @property string $redirect_url
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
class ExternalHttpRequest extends Model
{
    use MassPrunable;

    protected $guarded = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $casts = [
        'http_code' => 'int',
        'service_name' => Domain\ExternalService::class,
        'response_size' => 'int',
        'total_time_us' => 'int',
        'redirect_count' => 'int',
        'request_headers' => AsArrayObject::class,
        'redirect_time_us' => 'int',
        'response_headers' => 'array',
    ];

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }

    public function prunable()
    {
        return self::query()
            ->where('created_at', '<', now()->subWeeks(2));
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
