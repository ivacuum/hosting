<?php namespace App\Http\Controllers\Acp;

use App\Kanji as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Kanjis extends Controller
{
    protected $sort_dir = 'asc';
    protected $sort_key = 'level';
    protected $sortable_keys = ['level', 'meaning', 'radicals_count', 'similar_count'];
    protected $show_with_count = ['radicals', 'similar'];

    public function index()
    {
        $q = request('q');
        $kanji_id = request('kanji_id');
        $radical_id = request('radical_id');
        $similar_count = request('similar_count');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::withCount('radicals', 'similar')
            ->orderBy($sort_key, $sort_dir)
            ->when($sort_key === 'level', function (Builder $query) {
                return $query->orderBy('meaning');
            })
            ->when($radical_id, function (Builder $query) use ($radical_id) {
                return $query->whereHas('radicals', function (Builder $query) use ($radical_id) {
                    $query->where('radical_id', $radical_id);
                });
            })
            ->when($kanji_id, function (Builder $query) use ($kanji_id) {
                return $query->whereHas('similar', function (Builder $query) use ($kanji_id) {
                    $query->where('similar_id', $kanji_id);
                });
            })
            ->when(null !== $similar_count, function (Builder $query) use ($similar_count) {
                return $similar_count
                    ? $query->has('similar')
                    : $query->doesntHave('similar');
            })
            ->when($q, function (Builder $query) use ($q) {
                return $query->where('meaning', 'LIKE', "%{$q}%");
            })
            ->paginate()
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('models'));
    }

    protected function requestDataForModel()
    {
        $data = parent::requestDataForModel();

        if (!empty($data['similar_kanji'])) {
            $characters = $this->splitKanjiCharacters($data['similar_kanji']);

            $data['similar'] = Model::whereIn('character', $characters)
                ->get(['id'])
                ->pluck('id')
                ->all();

            request()->merge($data);
        }

        return $data;
    }

    protected function splitKanjiCharacters(string $string): array
    {
        $len = mb_strlen($string);
        $result = [];

        while ($len) {
            $result[] = mb_substr($string, 0, 1);
            $string = mb_substr($string, 1);
            $len--;
        }

        return $result;
    }

    /**
     * @param  Model $model
     */
    protected function updateModel($model)
    {
        parent::updateModel($model);

        $model->radicals()->sync(request('radicals', []));

        $result = $model->similar()->sync(request('similar', []));

        $ids = $model->similar->pluck('id')->push($model->id);

        $model->similar->each(function (Model $item) use ($ids) {
            $item->similar()->sync($ids->filter(function ($id) use ($item) {
                return $item->id !== $id;
            }));
        });

        $detached = Model::find($result['detached']);

        $detached->each(function (Model $item) use ($ids) {
            $item->similar()->detach();
        });
    }
}
