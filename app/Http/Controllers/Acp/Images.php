<?php namespace App\Http\Controllers\Acp;

use App\Image as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Images extends Controller
{
    protected $sortable_keys = ['id', 'size', 'views', 'updated_at'];

    public function index()
    {
        $type = request('type');
        $year = request('year');
        $touch = request('touch');
        $user_id = request('user_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::orderBy($sort_key, $sort_dir)
            // ->where('updated_at', '<', now()->subYear()->toDateTimeString())
            // ->where('views', '<', 1000);
            ->when($year, function (Builder $query) use ($year) {
                return $query->whereYear('created_at', $year);
            })
            ->when($touch, function (Builder $query) use ($touch) {
                return $query->whereYear('updated_at', now()->subYear($touch)->year);
            })
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->where('views', '<', 2000)
            ->where('user_id', '<>', 1)
            ->paginate(111)
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('models', 'touch', 'type', 'user_id', 'year'));
    }

    public function batch()
    {
        $ids = request('ids', []);
        $action = request('action');

        $models = Model::find($ids);

        foreach ($models as $model) {
            /* @var Model $model */
            if ($action === 'delete') {
                $model->delete();
            }
        }

        return $this->redirectAfterDestroy(null);
    }

    public function view($id)
    {
        /* @var Model $model */
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
