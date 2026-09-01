<?php

namespace App\Domain\Log\Models;

use App\Domain\Log\ExternalService;
use App\Domain\Log\HttpFailureCategory;
use App\Domain\Log\Policy\ExternalHttpRequestPolicy;
use Illuminate\Database\Eloquent\Attributes\DateFormat;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Uri;

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
 * @property int $queue_time_us
 * @property int $namelookup_time_us
 * @property int $connect_time_us
 * @property int $appconnect_time_us
 * @property int $pretransfer_time_us
 * @property int $posttransfer_time_us
 * @property int $starttransfer_time_us
 * @property int $total_time_us
 * @property int|null $http_code
 * @property string $http_version
 * @property int $redirect_count
 * @property int $redirect_time_us
 * @property string $redirect_url
 * @property string|null $primary_ip
 * @property int|null $primary_port
 * @property string|null $local_ip
 * @property int|null $local_port
 * @property int|null $ssl_verify_result
 * @property bool|null $used_proxy
 * @property int|null $curl_errno
 * @property int|null $os_errno
 * @property HttpFailureCategory|null $failure_category
 * @property string|null $curl_error
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
#[UsePolicy(ExternalHttpRequestPolicy::class)]
#[DateFormat('Y-m-d H:i:s.u')]
class ExternalHttpRequest extends Model
{
    use MassPrunable;

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }

    public function prunable(): Builder
    {
        return self::query()
            ->where('created_at', '<', now()->subWeeks(2));
    }

    public function toUri(): Uri
    {
        return Uri::of("{$this->scheme}://{$this->host}{$this->path}?{$this->query}");
    }

    #[\Override]
    protected function asJson($value, $flags = 0)
    {
        $flags |= JSON_UNESCAPED_UNICODE;

        return parent::asJson($value, $flags);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'http_code' => 'int',
            'service_name' => ExternalService::class,
            'failure_category' => HttpFailureCategory::class,
            'response_size' => 'int',
            'queue_time_us' => 'int',
            'namelookup_time_us' => 'int',
            'connect_time_us' => 'int',
            'appconnect_time_us' => 'int',
            'pretransfer_time_us' => 'int',
            'posttransfer_time_us' => 'int',
            'starttransfer_time_us' => 'int',
            'total_time_us' => 'int',
            'redirect_count' => 'int',
            'request_headers' => AsArrayObject::class,
            'redirect_time_us' => 'int',
            'response_headers' => 'array',
            'primary_port' => 'int',
            'local_port' => 'int',
            'ssl_verify_result' => 'int',
            'used_proxy' => 'bool',
            'curl_errno' => 'int',
            'os_errno' => 'int',
        ];
    }
}
