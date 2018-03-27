<?php namespace App\Observers;

use App\Email as Model;

class EmailObserver
{
    public function creating(Model $model)
    {
        if (!$model->locale) {
            $model->locale = \App::getLocale();
        }
    }
}
