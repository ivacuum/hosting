<?php namespace App\Utilities;

use Carbon\Carbon;
use Illuminate\Support\HtmlString;

class ViewHelper
{
    protected $decimal;

    public function __construct()
    {
        $this->decimal = new \NumberFormatter('ru_RU', \NumberFormatter::DECIMAL);
        $this->decimal->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
    }

    public function avatarBg($id)
    {
        return config('cfg.avatar_bg')[$id % 15];
    }

    public function chatTesters()
    {
        return \Auth::check() && (\Auth::user()->isRoot() || \Auth::user()->id === 257);
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

    public function inputHiddenMail()
    {
        return new HtmlString('<input hidden type="text" name="mail" value="'.old("mail").'">');
    }

    public function isMobile($user_agent)
    {
        return preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone|Opera Mini/i', $user_agent);
    }

    public function magnet($info_hash, $announcer, $title)
    {
        return "magnet:?xt=urn:btih:{$info_hash}&tr=" . urlencode($announcer) . "&dn=" . rawurlencode($title);
    }

    public function metaTitle($meta_title, $view)
    {
        if ($meta_title) {
            return $meta_title;
        }

        if (trans("meta_title.{$view}") !== "meta_title.{$view}") {
            return trans("meta_title.{$view}");
        }

        if (trans($view) !== $view) {
            return trans($view);
        }

        return config('cfg.sitename');
    }

    public function modelFieldTrans($model, $field)
    {
        $trans_key = "model.$model.$field";

        if (($text = trans($trans_key)) !== $trans_key) {
            return $text;
        }

        $trans_key_general = "model.$field";

        if (($text = trans($trans_key_general)) !== $trans_key_general) {
            return $text;
        }

        return $trans_key;
    }

    public function number($number)
    {
        return $this->decimal->format($number);
    }

    public function pic($folder, $file)
    {
        return "https://life.ivacuum.ru/-/1000x750/{$folder}/{$file}";
    }

    public function pic2x($folder, $file)
    {
        return "https://life.ivacuum.ru/{$folder}/{$file}";
    }

    public function picArbitrary($width, $height, $folder, $file)
    {
        return "https://life.ivacuum.ru/-/{$width}x{$height}/{$folder}/{$file}";
    }

    public function picThumb($folder, $file)
    {
        return "https://life.ivacuum.ru/-/100x75/{$folder}/{$file}";
    }

    public function plural($key, $count)
    {
        return trans_choice("plural.{$key}", $count, ['x' => $this->number($count)]);
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
