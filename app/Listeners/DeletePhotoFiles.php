<?php namespace App\Listeners;

use App\Photo;

class DeletePhotoFiles
{
    public function handle(Photo $model)
    {
        $model->deleteFiles();
    }
}
