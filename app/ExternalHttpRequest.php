<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Запрос к внешнему сервису
 *
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
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @mixin \Eloquent
 */
class ExternalHttpRequest extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'http_code' => 'int',
        'response_size' => 'int',
        'total_time_us' => 'int',
        'redirect_count' => 'int',
        'redirect_time_us' => 'int',
    ];

    // Methods
    public function breadcrumb()
    {
        return "#{$this->id}";
    }
}
