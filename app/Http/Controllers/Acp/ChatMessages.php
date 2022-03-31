<?php namespace App\Http\Controllers\Acp;

use App\ChatMessage as Model;
use App\Domain\ChatMessageStatus;
use Illuminate\Database\Eloquent\Builder;

class ChatMessages extends AbstractController
{
    public function index()
    {
        $status = request('status');
        $userId = request('user_id');

        $models = Model::query()
            ->with('user')
            ->unless(null === $status, fn (Builder $query) => $query->where('status', $status))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->orderByDesc('id')
            ->paginate();

        return view($this->view, [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
    }

    public function batch()
    {
        $ids = request('ids', []);
        $action = request('action');

        $models = Model::find($ids);

        foreach ($models as $model) {
            /** @var Model $model */
            if ($action === 'delete') {
                $model->delete();
            } elseif ($action === 'hide') {
                $model->status = ChatMessageStatus::Hidden;
                $model->save();
            } elseif ($action === 'publish') {
                $model->status = ChatMessageStatus::Published;
                $model->save();
            }
        }

        return $this->redirectAfterDestroy(new Model);
    }

    protected function rules($model = null)
    {
        return [
            'text' => 'required',
            'status' => 'required',
        ];
    }
}
