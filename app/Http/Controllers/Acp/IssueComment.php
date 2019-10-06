<?php namespace App\Http\Controllers\Acp;

use App\Comment;
use App\Issue as Model;
use App\Notifications\IssueCommented;
use Ivacuum\Generic\Controllers\Acp\Controller;

class IssueComment extends Controller
{
    public function __invoke(int $id): array
    {
        /** @var Model $model */
        $model = $this->getModel($id);

        if (!$model->canBeCommented()) {
            return [
                'status' => 'error',
                'message' => 'Это обращение нельзя комментировать',
            ];
        }

        $text = request('text');

        /** @var Comment $comment */
        $comment = $model->comments()->create([
            'html' => $text,
            'status' => Comment::STATUS_PUBLISHED,
            'user_id' => request()->user()->id,
        ]);

        \Notification::send($model->user, new IssueCommented($model, $comment));

        $comment->setRelation('user', request()->user());

        return [
            'status' => 'OK',
            'message' => 'Сообщение отправлено',
            'data' => new \App\Http\Resources\Acp\Comment($comment),
        ];
    }

    protected function getModelName(): string
    {
        return Model::class;
    }
}
