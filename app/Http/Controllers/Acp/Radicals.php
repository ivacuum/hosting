<?php namespace App\Http\Controllers\Acp;

use App\Radical as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Radicals extends Controller
{
    protected $sort_dir = 'asc';
    protected $sort_key = 'level';
    protected $sortable_keys = ['level', 'meaning', 'kanjis_count'];
    protected $show_with_count = ['kanjis'];

    public function index()
    {
        $kanji_id = request('kanji_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::withCount('kanjis')
            ->orderBy($sort_key, $sort_dir)
            ->when($kanji_id, function (Builder $query) use ($kanji_id) {
                return $query->whereHas('kanjis', function (Builder $query) use ($kanji_id) {
                    $query->where('kanji_id', $kanji_id);
                });
            })
            ->when($sort_key === 'level', function (Builder $query) {
                return $query->orderBy('meaning');
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

        if (request()->has('kanjis')) {
            $model->kanjis()->sync(request('kanjis'));
        } else {
            $model->kanjis()->detach();
        }
    }
}
