<?php namespace App\Action;

use App\Domain\CacheKey;
use Illuminate\Cache\Repository;

class GetNumberLocalesAction
{
    public function __construct(private Repository $cache)
    {
    }

    public function execute(): array
    {
        $key = CacheKey::IcuLocales;

        return $this->cache->remember($key->value, $key->ttl(), function () {
            return collect(\ResourceBundle::getLocales(''))
                ->reject(fn (string $locale) => mb_strlen($locale) > 2)
                ->reject(function (string $locale) {
                    $formatter = new \NumberFormatter($locale, \NumberFormatter::SPELLOUT);

                    if ($locale !== $formatter->getLocale()) {
                        return true;
                    }

                    return false;
                })
                ->values()
                ->all();
        });
    }
}
