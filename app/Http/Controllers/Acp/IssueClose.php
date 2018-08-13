<?php namespace App\Http\Controllers\Acp;

use App\Issue as Model;
use Ivacuum\Generic\Controllers\Acp\Controller;

class IssueClose extends Controller
{
    public function __invoke(int $id): array
    {
        /* @var Model $model */
        $model = $this->getModel($id);

        if (!$model->canBeClosed()) {
            return [
                'status' => 'error',
                'message' => 'Обращение не может быть закрыто',
            ];
        }

        $model->status = Model::STATUS_CLOSED;
        $model->save();

        return [
            'status' => 'OK',
            'message' => 'Обращение решено',
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
