<?php namespace App\Observers;

use App\YandexUser as Model;

class YandexUserObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->domains()->update(['yandex_user_id' => 0]);
        });
    }
}
