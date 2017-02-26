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

    public function scopeWeek($query)
    {
        return $query->where('date', '>', Carbon::now()->subWeek()->toDateString());
    }

    public static function possibleMetrics()
    {
        foreach (glob(app_path('Events/Stats/*.php')) as $file) {
            $events[] = pathinfo($file, PATHINFO_FILENAME);
        }

        return $events ?? [];
    }
}
