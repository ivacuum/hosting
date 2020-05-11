<?php namespace App\Http\Controllers\Acp;

use App\Image as Model;
use Illuminate\Database\Eloquent\Builder;

class Images extends AbstractController
{
    protected $sortableKeys = ['id', 'size', 'views', 'updated_at'];

    public function index()
    {
        $type = request('type');
        $year = request('year');
        $touch = request('touch');
        $userId = request('user_id');

        $models = Model::query()
            ->when($year, fn (Builder $query) => $query->whereYear('created_at', $year))
            ->when($touch, fn (Builder $query) => $query->whereYear('updated_at', now()->subYears($touch)->year))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->when(\App::isProduction(), fn (Builder $query) => $query->where('views', '<', 3000)->where('user_id', '<>', 1))
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate(111);

        return view($this->view, [
            'type' => $type,
            'year' => $year,
            'touch' => $touch,
            'models' => $models,
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
            }
        }

        return $this->redirectAfterDestroy(null);
    }

    public function view($id)
    {
        /** @var Model $model */
        $model = $this->getModel($id);

        $model->views++;
        $model->save();

        return back();
    }

    protected function redirectAfterDestroy($model)
    {
        return [
            'status' => 'OK',
            'redirect' => request()->header('referer'),
        ];
    }
}
