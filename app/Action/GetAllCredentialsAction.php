<?php namespace App\Action;

use Illuminate\Support\Collection;

class GetAllCredentialsAction
{
    public function execute(): Collection
    {
        return collect(\Arr::dot(config('services')))
            ->filter(fn ($value, $key) => $value && \Str::endsWith($key, ['_key', '_secret', '_token']))
            ->mapWithKeys(fn ($value, $key) => [str($key)->replace('.', '_')->studly()->value() => $value]);
    }
}
