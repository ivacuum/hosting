<?php namespace App\Observers;

use App\Image as Model;

class ImageObserver
{
    public function deleted(Model $model)
    {
        $model->deleteFiles();
    }
}
