<?php

namespace App\Domain\Log\Action;

use App\Domain\Log\ExternalService;

class GetExternalServiceByHostAction
{
    public function execute(string $host): ExternalService
    {
        return match ($host) {
            'api.vk.com' => ExternalService::Vk,
            'api.telegram.org' => ExternalService::Telegram,
            'api.wanikani.com' => ExternalService::Wanikani,

            'api.rutracker.cc',
            'api-rto.vacuum.name',
            'rto.vacuum.name',
            'rutracker.org' => ExternalService::Rutracker,

            'example.com' => ExternalService::Example,

            'graph.vacuum.name' => ExternalService::Instagram,

            'life.ivacuum.org' => ExternalService::Life,

            default => ExternalService::Unknown,
        };
    }
}
