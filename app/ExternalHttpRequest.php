<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $service_name
 * @property string $method
 * @property string $scheme
 * @property string $host
 * @property string $path
 * @property string $query
 * @property string $request_headers
 * @property string $request_body
 * @property string $response_headers
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
    protected $guarded = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $casts = [
        'http_code' => 'int',
        'response_size' => 'int',
        'total_time_us' => 'int',
        'redirect_count' => 'int',
        'request_headers' => 'array',
        'redirect_time_us' => 'int',
        'response_headers' => 'array',
    ];

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
