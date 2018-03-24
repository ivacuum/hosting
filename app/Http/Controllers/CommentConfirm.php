<?php namespace App\Http\Controllers;

use App\Comment as Model;

class CommentConfirm extends Controller
{
    public function update(int $id)
    {
        $user = request()->user();

        /* @var Model $model */
        $model = Model::findOrFail($id);

        abort_unless($model->user_id === $user->id, 404);

        if ($model->status !== Model::STATUS_PENDING) {
            return redirect($model->rel->www())
                ->with('message', trans('comments.already_confirmed'));
        }

        $model->status = Model::STATUS_PUBLISHED;
        $model->save();

        return redirect($model->rel->www($model->anchor()));
    }
}
