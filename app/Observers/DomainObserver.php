<?php namespace App\Observers;

use App\Domain as Model;

class DomainObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->aliases()->update(['alias_id' => 0]);
        });
    }
}
