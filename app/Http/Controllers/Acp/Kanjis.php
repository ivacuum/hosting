<?php namespace App\Http\Controllers\Acp;

use App\Kanji as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Kanjis extends Controller
{
    protected $sort_dir = 'asc';
    protected $sort_key = 'level';
    protected $sortable_keys = ['level', 'meaning', 'radicals_count'];
    protected $show_with_count = ['radicals'];

    public function index()
    {
        $q = request('q');
        $radical_id = request('radical_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::withCount('radicals')
            ->orderBy($sort_key, $sort_dir)
            ->when($sort_key === 'level', function (Builder $query) {
                return $query->orderBy('meaning');
            })
            ->when($radical_id, function (Builder $query) use ($radical_id) {
                return $query->whereHas('radicals', function (Builder $query) use ($radical_id) {
                    $query->where('radical_id', $radical_id);
                });
            })
            ->when($q, function (Builder $query) use ($q) {
                return $query->where('meaning', 'LIKE', "%{$q}%");
            })
            ->paginate()
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('models'));
    }

    /**
     * @param  Model $model
     */
    protected function updateModel($model)
    {
        parent::updateModel($model);

        if (request()->has('radicals')) {
            $model->radicals()->sync(request('radicals'));
        } else {
            $model->radicals()->detach();
        }
    }
}
