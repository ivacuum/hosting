<?php namespace App\Action;

use App\Domain;
use App\YandexUser;

class SyncYandexUserDomainsAction
{
    public function execute(YandexUser $yandexUser, array $domains): void
    {
        $current = $yandexUser->domains()->pluck('id');

        $toAdd = array_diff($domains, $current->all());
        $toRemove = array_diff($current->all(), $domains);

        Domain::query()
            ->whereIn('id', $toRemove)
            ->update(['yandex_user_id' => 0]);

        Domain::query()
            ->whereIn('id', $toAdd)
            ->update(['yandex_user_id' => $yandexUser->id]);
    }
}
