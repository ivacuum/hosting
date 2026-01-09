<?php

namespace App\Utilities;

use App\Rules\ConcurrencyControl;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\HtmlString;

class ViewHelper
{
    protected static $thousandsSeparator = '&thinsp;';

    public function avatarBg(int $id): string
    {
        return config('cfg.avatar_bg')[$id % count(config('cfg.avatar_bg'))];
    }

    public function dateShort(CarbonInterface|null $date): string
    {
        if ($date === null) {
            return '—';
        }

        $year = now()->year;

        if ($date->year === $year) {
            return $date->isoFormat('D MMMM');
        }

        return $date->isoFormat('D MMMM YYYY');
    }

    public function inputHiddenConcurrencyControl($value)
    {
        return new HtmlString('<input hidden type="text" name="' . ConcurrencyControl::FIELD . '" value="' . md5($value) . '">');
    }

    public function inputHiddenMail()
    {
        return new HtmlString('<input hidden type="text" name="mail" value="' . old('mail') . '">');
    }

    public function magnet(string $infoHash, string $announcer, string $title): string
    {
        return "magnet:?xt=urn:btih:{$infoHash}&tr=" . urlencode($announcer) . '&dn=' . rawurlencode($title);
    }

    public function metaDescription(string $view, array $replace = []): string
    {
        if (__("meta_description.{$view}") !== "meta_description.{$view}") {
            return __("meta_description.{$view}", $replace);
        }

        return '';
    }

    public function metaKeywords(string $view, array $replace = []): string
    {
        if (__("meta_keywords.{$view}") !== "meta_keywords.{$view}") {
            return __("meta_keywords.{$view}", $replace);
        }

        return '';
    }

    public function metaTitle(string $view, array $replace = []): string
    {
        if (__("meta_title.{$view}") !== "meta_title.{$view}") {
            return __("meta_title.{$view}", $replace);
        }

        $result = __($view);

        if (!is_array($result) && $result !== $view) {
            return $result;
        }

        return config('cfg.sitename');
    }

    public function modelFieldTrans(string $model, string $field): string
    {
        if ($model) {
            $transKey = "model.$model.$field";

            if (($text = __($transKey)) !== $transKey) {
                return $text;
            }
        }

        $transKeyGeneral = "model.$field";

        if (($text = __($transKeyGeneral)) !== $transKeyGeneral) {
            return $text;
        }

        return $model
            ? "model.$model.$field"
            : "model.$field";
    }

    public function number(int $number): string
    {
        $decimal = new \NumberFormatter('ru_RU', \NumberFormatter::DECIMAL);
        $decimal->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
        $decimal->setSymbol(\NumberFormatter::GROUPING_SEPARATOR_SYMBOL, static::$thousandsSeparator);

        return $decimal->format($number);
    }

    public function numberShort(int $number): string
    {
        $units = ['', 'K', 'M'];
        $decimals = [0, 0, 0];

        $number = max($number, 0);
        $pow = floor(($number ? log($number) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $number /= 1024 ** $pow;

        return round($number, $decimals[$pow]) . $units[$pow];
    }

    public function paginatorIteration($paginator, $loop): int
    {
        $page = $perPage = 0;

        if ($paginator instanceof LengthAwarePaginator) {
            $page = $paginator->currentPage() - 1;
            $perPage = $paginator->perPage();
        }

        return $page * $perPage + $loop->iteration;
    }

    public function pic(string $folder, string $file): string
    {
        return "https://life.ivacuum.org/-/1000x750/{$folder}/{$file}";
    }

    public function pic2x(string $folder, string $file): string
    {
        return "https://life.ivacuum.org/{$folder}/{$file}";
    }

    public function picArbitrary(int $width, int $height, string $folder, string $file): string
    {
        return "https://life.ivacuum.org/-/{$width}x{$height}/{$folder}/{$file}";
    }

    public function picThumb(string $folder, string $file): string
    {
        return "https://life.ivacuum.org/-/100x75/{$folder}/{$file}";
    }

    public function plural(string $key, int $count): string
    {
        return trans_choice("plural.{$key}", $count, ['x' => $this->number($count)]);
    }

    public function size(int $bytes): string
    {
        $units = [
            __('size.b'),
            __('size.kb'),
            __('size.mb'),
            __('size.gb'),
            __('size.tb'),
        ];

        $decimals = [0, 0, 1, 1, 1];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= 1024 ** $pow;

        return round($bytes, $decimals[$pow]) . static::$thousandsSeparator . $units[$pow];
    }
}
