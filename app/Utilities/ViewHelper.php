<?php namespace App\Utilities;

use Carbon\Carbon;

class ViewHelper
{
    protected $decimal;

    public function __construct()
    {
        $this->decimal = new \NumberFormatter('ru_RU', \NumberFormatter::DECIMAL);
        $this->decimal->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
    }

    public function dateShort(Carbon $date)
    {
        static $year;

        if (empty($year)) {
            $year = Carbon::now()->year;
        }

        if ($date->year === $year) {
            return $date->formatLocalized('%e %B');
        }

        return $date->formatLocalized('%e %b %Y');
    }

    public function number($number)
    {
        return $this->decimal->format($number);
    }

    public function pic($folder, $file)
    {
        return "https://life.ivacuum.ru/{$folder}/{$file}";
    }

    public function pic2x($folder, $file)
    {
        $pathinfo = pathinfo($file);

        return "https://life.ivacuum.ru/{$folder}/{$pathinfo['filename']}@2x.{$pathinfo['extension']}";
    }

    public function picThumb($folder, $file)
    {
        return "https://life.ivacuum.ru/{$folder}/t/{$file}";
    }

    public function size($bytes)
    {
        $units = [
            trans('size.b'),
            trans('size.kb'),
            trans('size.mb'),
            trans('size.gb'),
            trans('size.tb'),
        ];

        $decimals = [0, 0, 1, 1, 1];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, sizeof($units) - 1);
        $bytes /= pow(1024, $pow);

        return round($bytes, $decimals[$pow]) . '&nbsp;' . $units[$pow];
    }
}
