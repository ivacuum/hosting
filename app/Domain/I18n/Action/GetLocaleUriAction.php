<?php

namespace App\Domain\I18n\Action;

use App\Domain\Config;

class GetLocaleUriAction
{
    public function execute(): string
    {
        $locale = app()->getLocale();
        $defaultLocale = Config::DefaultLocale->get();

        if ($locale !== $defaultLocale) {
            return "/{$locale}";
        }

        return '';
    }
}
