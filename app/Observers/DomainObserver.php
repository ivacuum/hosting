<?php

namespace App\Observers;

use App\Domain;

class DomainObserver
{
    public function deleting(Domain $domain)
    {
        \DB::transaction(function () use ($domain) {
            $domain->aliases()->update(['alias_id' => 0]);
        });
    }
}
