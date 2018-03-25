<?php namespace App\Observers;

use App\Photo as Model;

class PhotoObserver
{
    public function deleted(Model $model)
    {
        $model->deleteFiles();
    }
}
