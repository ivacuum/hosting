<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Торрент
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $rto_id
 * @property string  $title
 * @property string  $html
 * @property integer $size
 * @property integer $seeders
 * @property string  $info_hash
 * @property string  $announcer
 * @property integer $clicks
 * @property \Carbon\Carbon $registered_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\User $user
 */
class Torrent extends Model
{
    const STATUS_0 = 1; // не проверено
    const STATUS_1 = 1; // закрыто
    const STATUS_2 = 2; // проверено
    const STATUS_3 = 3; // недооформлено
    const STATUS_4 = 4; // не оформлено
    const STATUS_DUPLICATE = 5; // повтор
    const STATUS_6 = 6; // закрыто правообладателем
    const STATUS_7 = 7; // поглощено
    const STATUS_8 = 8; // сомнительно
    const STATUS_9 = 9; // проверяется
    const STATUS_10 = 10; // временная
    const STATUS_11 = 11; // премодерация

    protected $guarded = ['created_at', 'updated_at', 'goto'];
    protected $dates = ['registered_at'];
    protected $perPage = 50;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function magnet()
    {
        return "magnet:?xt=urn:btih:{$this->info_hash}&tr=" . urlencode($this->announcer) . "&dn=" . rawurlencode($this->title);
    }

    public function shortDate()
    {
        return $this->registered_at->year == date('Y')
            ? $this->registered_at->formatLocalized('%e&nbsp;%b')
            : $this->registered_at->formatLocalized('%e&nbsp;%b&nbsp;%Y');
    }

    public static function statsByCategories()
    {
        $result = self::selectRaw('category_id, COUNT(*) as total')
            ->groupBy('category_id')
            ->get();

        $stats = [];

        foreach ($result as $row) {
            $stats[$row->category_id] = $row->total;
        }

        return $stats;
    }
}
