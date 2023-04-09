<?php namespace App\Observers;

use App\YandexUser;

class YandexUserObserver
{
    public function deleting(YandexUser $yandexUser)
    {
        \DB::transaction(function () use ($yandexUser) {
            $yandexUser->domains()->update(['yandex_user_id' => 0]);
        });
    }
}
