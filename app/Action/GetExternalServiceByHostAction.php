<?php

namespace App\Action;

use App\Domain\ExternalService;

class GetExternalServiceByHostAction
{
    public function execute(string $host): ExternalService
    {
        return match ($host) {
            'api.vk.com' => ExternalService::Vk,
            'api.telegram.org' => ExternalService::Telegram,
            'api.wanikani.com' => ExternalService::Wanikani,

            'api.rutracker.cc',
            'rutracker.org' => ExternalService::Rutracker,

            'example.com' => ExternalService::Example,

            'life.ivacuum.org' => ExternalService::Life,

            default => ExternalService::Unknown,
        };
    }
}
