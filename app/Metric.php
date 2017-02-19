<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Метрики
 *
 * @property \Carbon\Carbon $date
 * @property string  $event
 * @property integer $count
 */
class Metric extends Model
{
    protected $guarded = ['*'];
    protected $perPage = 100;

    public function scopeToday($query)
    {
        return $query->where('date', Carbon::now()->toDateString());
    }
}
