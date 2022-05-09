<?php namespace App\Action\Acp;

use App\Action\ParseRouteDataAction;
use Illuminate\Database\Eloquent\Model;

class ResponseToShowAction
{
    public function __construct(
        private GetModelAccessibleRelationsAction $getModelAccessibleRelations,
        private ParseRouteDataAction $parseRouteData
    ) {
    }

    public function execute(Model $model, array $showWithCount = [])
    {
        return \View::first([$this->parseRouteData->execute()->view, 'acp.show'], [
            'model' => $model,
            'modelRelations' => $this->getModelAccessibleRelations
                ->execute($model, $showWithCount)
                ->jsonSerialize(),
        ]);
    }
}
