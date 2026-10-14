<?php

namespace App\Action;

use App\Domain\CacheKey;
use Illuminate\Cache\Repository;

class GetNumberLocalesAction
{
    public function __construct(private Repository $cache) {}

    public function execute(): array
    {
        $key = CacheKey::IcuLocales;

        return $this->cache->remember($key->key(INTL_ICU_VERSION), $key->ttl(), static function (): array {
            return collect(\ResourceBundle::getLocales('ICUDATA-rbnf'))
                ->filter(static fn (string $locale) => \Locale::getPrimaryLanguage($locale) === $locale)
                ->filter(static function (string $locale): bool {
                    $formatter = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);

                    return $locale === $formatter->getLocale(\Locale::ACTUAL_LOCALE);
                })
                ->values()
                ->all();
        });
    }
}
