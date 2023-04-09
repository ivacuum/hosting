<?php namespace App\Scope;

use App\Domain\DomainMonitoring;
use Illuminate\Database\Eloquent\Builder;

class DomainYandexReadyScope
{
    public function __construct(private int|null $userId = null)
    {
    }

    public function __invoke(Builder $query)
    {
        $query->where('status', DomainMonitoring::Yes)
            ->orderBy('domain');

        $this->userId === null
            ? $query->where('yandex_user_id', 0)
            : $query->whereIn('yandex_user_id', [0, $this->userId]);
    }
}
