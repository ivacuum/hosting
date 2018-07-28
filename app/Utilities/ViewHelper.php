<?php namespace App\Utilities;

use Ivacuum\Generic\Utilities\ViewHelper as BaseViewHelper;

class ViewHelper extends BaseViewHelper
{
    public function magnet($info_hash, $announcer, $title)
    {
        return "magnet:?xt=urn:btih:{$info_hash}&tr=" . urlencode($announcer) . "&dn=" . rawurlencode($title);
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

    public function prependTransKeysForJson(string $file): array
    {
        $trans = trans($file);

        return array_combine(
            array_map(function ($key) use ($file) {
                return "{$file}.{$key}";
            }, array_keys($trans)),
            array_values($trans)
        );
    }
}
