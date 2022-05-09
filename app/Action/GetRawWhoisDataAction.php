<?php namespace App\Action;

use App\WhoisQuery;

class GetRawWhoisDataAction
{
    public function execute(string $domain): string
    {
        return trim((new WhoisQuery($domain))
            ->getRaw());
    }
}
