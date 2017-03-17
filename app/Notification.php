<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Уведомление
 *
 * @property integer $id
 * @property string  $type
 * @property integer $notifiable_id
 * @property string  $notifiable_type
 * @property string  $data
 * @property \Carbon\Carbon $read_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Notification extends Model
{
    protected $keyType = 'string';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['read_at'];
    protected $perPage = 50;

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function breadcrumb()
    {
        return $this->id;
    }
}
