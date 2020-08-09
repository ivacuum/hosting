<?php namespace App\Utilities;

use Ivacuum\Generic\Utilities\NamingHelper;
use Ivacuum\Generic\Utilities\ViewHelper as BaseViewHelper;

class ViewHelper extends BaseViewHelper
{
    public function magnet(string $infoHash, string $announcer, string $title): string
    {
        return "magnet:?xt=urn:btih:{$infoHash}&tr=" . urlencode($announcer) . "&dn=" . rawurlencode($title);
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

    public function prependTransKeysForJson(string $file, bool $vueI18nFormatter = false): array
    {
        $trans = __($file);

        return array_combine(
            array_map(fn ($key) => "{$file}.{$key}", array_keys($trans)),
            $vueI18nFormatter
                ? array_map(fn ($value) => preg_replace('/:(\w+)/', '{$1}', $value), array_values($trans))
                : array_values($trans)
        );
    }
}
