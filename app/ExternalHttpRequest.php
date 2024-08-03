<?php

namespace App;

use App\Domain\ExternalService;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property ExternalService $service_name
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

    protected $dateFormat = 'Y-m-d H:i:s.u';

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }

    public function prunable()
    {
        $thresholdId = self::query()
            ->where('created_at', '<', now()->subWeeks(2))
            ->orderByDesc('id')
            ->first(['id'])
            ->id;

        return self::query()
            ->where('id', '<=', $thresholdId)
            ->limit(1_000_000);
    }

    #[\Override]
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'http_code' => 'int',
            'service_name' => ExternalService::class,
            'response_size' => 'int',
            'total_time_us' => 'int',
            'redirect_count' => 'int',
            'request_headers' => AsArrayObject::class,
            'redirect_time_us' => 'int',
            'response_headers' => 'array',
        ];
    }
}
