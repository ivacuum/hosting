<?php namespace App\Http\Controllers\Acp;

use App\Issue as Model;
use Ivacuum\Generic\Controllers\Acp\Controller;

class IssueOpen extends Controller
{
    public function __invoke(int $id): array
    {
        /** @var Model $model */
        $model = $this->getModel($id);

        if (!$model->canBeOpened()) {
            return [
                'status' => 'error',
                'message' => 'Обращение не может быть открыто',
            ];
        }

        $model->status = Model::STATUS_OPEN;
        $model->save();

        return [
            'status' => 'OK',
            'message' => 'Обращение вновь открыто',
            'data' => [
                'status' => $model->status,
            ],
        ];
    }

    protected function getModelName(): string
    {
        return Model::class;
    }
}
