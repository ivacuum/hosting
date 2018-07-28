<?php namespace App\Utilities;

use Ivacuum\Generic\Utilities\NamingHelper;
use Ivacuum\Generic\Utilities\ViewHelper as BaseViewHelper;

class ViewHelper extends BaseViewHelper
{
    public function magnet(string $info_hash, string $announcer, string $title): string
    {
        return "magnet:?xt=urn:btih:{$info_hash}&tr=" . urlencode($announcer) . "&dn=" . rawurlencode($title);
    }

    public function modelsSingularAndPluralForms(): array
    {
        $forms = [];

        foreach (glob(app_path('*.php')) as $file) {
            $model = pathinfo($file, PATHINFO_FILENAME);

            $forms[$model] = [
                'plural' => NamingHelper::transField($model),
                'singular' => NamingHelper::kebab($model),
            ];
        }

        return $forms;
    }

    public function pic(string $folder, string $file): string
    {
        return "https://life.ivacuum.ru/-/1000x750/{$folder}/{$file}";
    }

    public function pic2x(string $folder, string $file): string
    {
        return "https://life.ivacuum.ru/{$folder}/{$file}";
    }

    public function picArbitrary(int $width, int $height, string $folder, string $file): string
    {
        return "https://life.ivacuum.ru/-/{$width}x{$height}/{$folder}/{$file}";
    }

    public function picThumb(string $folder, string $file): string
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
