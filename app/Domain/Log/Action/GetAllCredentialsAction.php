<?php

namespace App\Domain\Log\Action;

use Illuminate\Support\Collection;

class GetAllCredentialsAction
{
    public function execute(): Collection
    {
        return collect(config('services'))
            ->dot()
            ->filter(static fn ($value, $key) => $value && \Str::endsWith($key, ['_key', '_secret', '_token']))
            ->mapWithKeys(static fn ($value, $key) => [str($key)->replace('.', '_')->studly()->value() => $value]);
    }
}
