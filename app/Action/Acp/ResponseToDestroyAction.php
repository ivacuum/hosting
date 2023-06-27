<?php

namespace App\Action\Acp;

use Illuminate\Database\Eloquent\Model;

class ResponseToDestroyAction
{
    public function __construct(private GetModelControllerAction $getModelController)
    {
    }

    public function execute(Model $model)
    {
        $model->deleteOrFail();

        return [
            'status' => 'OK',
            'redirect' => path([$this->getModelController->execute($model), 'index']),
        ];
    }
}
