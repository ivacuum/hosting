<?php namespace App\Http\Controllers\Acp;

use App\Image as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Images extends Controller
{
    protected $sortable_keys = ['id', 'size', 'views', 'updated_at'];

    public function index()
    {
        $type = $this->request->input('type');
        $year = $this->request->input('year');
        $touch = $this->request->input('touch');
        $user_id = $this->request->input('user_id');

        list($sort_key, $sort_dir) = $this->getSortParams();

        $models = Model::orderBy($sort_key, $sort_dir)
            // ->where('updated_at', '<', Carbon::now()->subYear()->toDateTimeString())
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
            ->paginate();

        return view($this->view, compact('models', 'touch', 'type', 'user_id', 'year'));
    }

    public function batch()
    {
        $ids = $this->request->input('ids');
        $action = $this->request->input('action');

        $models = Model::find($ids);

        foreach ($models as $model) {
            /* @var Model $model */
            if ($action === 'delete') {
                $model->delete();
            }
        }

        return $this->redirectAfterDestroy($model);
    }

    public function view($id)
    {
        $model = $this->getModel($id);

        $model->views++;
        $model->save();

        return back();
    }

    protected function redirectAfterDestroy($model)
    {
        return [
            'status' => 'OK',
            'redirect' => $this->request->header('referer'),
        ];
    }
}
