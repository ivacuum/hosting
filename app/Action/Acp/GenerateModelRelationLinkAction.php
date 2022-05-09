<?php namespace App\Action\Acp;

use Illuminate\Database\Eloquent\Model;

class GenerateModelRelationLinkAction
{
    public function execute(Model $model, Model $relatedModel): string
    {
        $section = str(class_basename($relatedModel))
            ->plural()
            ->kebab()
            ->toString();

        return to("acp/{$section}", [$model->getForeignKey() => $model->getKey()]);
    }
}
