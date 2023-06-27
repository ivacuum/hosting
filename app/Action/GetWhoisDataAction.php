<?php

namespace App\Action;

use App\WhoisQuery;
use Carbon\CarbonImmutable;

class GetWhoisDataAction
{
    public function execute(string $domain): array|null
    {
        $query = new WhoisQuery($domain);
        $data = array_merge($query->parse(), $query->getDnsRecords());

        // whois failed
        if (empty($data['registered_at'])) {
            return null;
        }

        $data['registered_at'] = CarbonImmutable::parse($data['registered_at']);
        $data['paid_till'] = CarbonImmutable::parse($data['paid_till']);
        $data['queried_at'] = now();
        $data['raw'] = $query->getRaw();

        return $data;
    }
}
