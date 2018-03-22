<?php namespace App;

use App\Traits\HasLocalizedTitle;
use App\Traits\HasTripsMetaDescription;
use Illuminate\Database\Eloquent\Model;

/**
 * Страна
 *
 * @property integer $id
 * @property string  $title_ru
 * @property string  $title_en
 * @property string  $slug
 * @property string  $emoji
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property-read \App\City $cities
 * @property-read \App\Trip $trips
 *
 * @property-read string  $title
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    use HasLocalizedTitle,
        HasTripsMetaDescription;

    protected $guarded = ['created_at', 'updated_at', 'goto'];

    // Relations
    public function cities()
    {
        return $this->hasMany(City::class)
            ->orderBy(static::titleField());
    }

    public function trips()
    {
        return $this->hasManyThrough(Trip::class, City::class)
            ->orderBy('date_start', 'asc');
    }

    // Methods
    public function breadcrumb(): string
    {
        return "{$this->emoji} {$this->title}";
    }

    public function flagCode(): string
    {
        switch ($this->slug) {
            case 'afghanistan': return 'af';
            case 'albania': return 'al';
            case 'andorra': return 'ad';
            case 'argentina': return 'ar';
            case 'armenia': return 'am';
            case 'australia': return 'au';
            case 'austria': return 'at';
            case 'azerbaijan': return 'az';
            case 'belarus': return 'by';
            case 'belgium': return 'be';
            case 'brazil': return 'br';
            case 'bulgaria': return 'bg';
            case 'cambodia': return 'kh';
            case 'canada': return 'ca';
            case 'chile': return 'cl';
            case 'china': return 'cn';
            case 'colombia': return 'co';
            case 'croatia': return 'hr';
            case 'cuba': return 'cu';
            case 'cyprus': return 'cy';
            case 'czech-republic': return 'cz';
            case 'denmark': return 'dk';
            case 'ecuador': return 'ec';
            case 'egypt': return 'eg';
            case 'estonia': return 'ee';
            case 'finland': return 'fi';
            case 'france': return 'fr';
            case 'georgia': return 'ge';
            case 'germany': return 'de';
            case 'greece': return 'gr';
            case 'greenland': return 'gl';
            case 'hungary': return 'hu';
            case 'iceland': return 'is';
            case 'india': return 'in';
            case 'indonesia': return 'id';
            case 'iran': return 'ir';
            case 'iraq': return 'iq';
            case 'ireland': return 'ie';
            case 'israel': return 'il';
            case 'italy': return 'it';
            case 'jamaica': return 'jm';
            case 'japan': return 'jp';
            case 'jordan': return 'jo';
            case 'kazakhstan': return 'kz';
            case 'latvia': return 'lv';
            case 'liechtenstein': return 'li';
            case 'lithuania': return 'lt';
            case 'luxembourg': return 'lu';
            case 'macedonia': return 'mk';
            case 'magadascar': return 'mg';
            case 'malaysia': return 'my';
            case 'maldives': return 'mv';
            case 'malta': return 'mt';
            case 'mexico': return 'mx';
            case 'moldova': return 'md';
            case 'monaco': return 'mc';
            case 'mongolia': return 'mn';
            case 'montenegro': return 'me';
            case 'morocco': return 'ma';
            case 'nepal': return 'np';
            case 'netherlands': return 'nl';
            case 'new-zealand': return 'nz';
            case 'norway': return 'no';
            case 'oman': return 'om';
            case 'pakistan': return 'pk';
            case 'panama': return 'pa';
            case 'paraguay': return 'py';
            case 'peru': return 'pe';
            case 'philippines': return 'ph';
            case 'poland': return 'pl';
            case 'portugal': return 'pt';
            case 'qatar': return 'qa';
            case 'romania': return 'ro';
            case 'russia': return 'ru';
            case 'seychelles': return 'sc';
            case 'singapore': return 'sg';
            case 'slovakia': return 'sk';
            case 'slovenia': return 'si';
            case 'south-africa': return 'za';
            case 'south-korea': return 'kr';
            case 'spain': return 'es';
            case 'sri-lanka': return 'lk';
            case 'sudan': return 'sd';
            case 'sweden': return 'se';
            case 'switzerland': return 'ch';
            case 'taiwan': return 'tw';
            case 'tajikistan': return 'tj';
            case 'thailand': return 'th';
            case 'tunisia': return 'tn';
            case 'turkey': return 'tr';
            case 'uae': return 'ae';
            case 'ukraine': return 'ua';
            case 'united-kingdom': return 'gb';
            case 'usa': return 'us';
            case 'uzbekistan': return 'uz';
            case 'venezuela': return 've';
            case 'vietnam': return 'vn';
            case 'yemen': return 'ye';
            case 'zambia': return 'zm';
            case 'zimbabwe': return 'zw';
        }

        return '';
    }

    public function flagUrl(): string
    {
        return ($code = $this->flagCode())
            ? "https://ivacuum.org/i/flags/svg/{$code}.svg"
            : "https://life.ivacuum.ru/0.gif";
    }

    public static function forInputSelect()
    {
        $title_field = static::titleField();

        return static::orderBy($title_field)->get(['id', $title_field])->pluck($title_field, 'id');
    }

    public function initial(): string
    {
        return mb_substr($this->title, 0, 1);
    }

    public function metaTitle(): string
    {
        return "{$this->emoji} {$this->title}";
    }

    public function www(): string
    {
        return path('Life@country', $this->slug);
    }
}
