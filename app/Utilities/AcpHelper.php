<?php namespace App\Utilities;

use App\Action\Acp\GetModelControllerAction;
use Illuminate\Database\Eloquent\Model;

class AcpHelper
{
    public function __construct(private GetModelControllerAction $getModelController)
    {
    }

    public function create(Model $model): string
    {
        return path([$this->getModelController->execute($model), 'create']);
    }

    public function destroy(Model $model): string
    {
        return path([$this->getModelController->execute($model), 'destroy'], $model);
    }

    public function edit(Model $model): string
    {
        return path(
            [$this->getModelController->execute($model), 'edit'],
            [$model, 'goto' => $this->go() . "#{$model->getRouteKeyName()}-{$model->getRouteKey()}"]
        );
    }

    public function index(Model $model, Model|null $foreign = null): string
    {
        if ($foreign) {
            return path(
                [$this->getModelController->execute($model), 'index'],
                [$foreign->getForeignKey() => $foreign]
            );
        }

        return path([$this->getModelController->execute($model), 'index']);
    }

    public function go(array $query = []): string
    {
        return fullUrl($query);
    }

    public function show(Model $model, Model|string|int|null $id = null): string
    {
        return path([$this->getModelController->execute($model), 'show'], $id ?? $model);
    }
}
