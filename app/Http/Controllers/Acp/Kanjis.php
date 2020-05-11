<?php namespace App\Http\Controllers\Acp;

use App\Kanji as Model;
use Illuminate\Database\Eloquent\Builder;

class Kanjis extends AbstractController
{
    protected $sortDir = 'asc';
    protected $sortKey = 'level';
    protected $sortableKeys = ['level', 'meaning', 'radicals_count', 'similar_count'];
    protected $showWithCount = ['radicals', 'similar'];

    public function index()
    {
        $q = request('q');
        $kanjiId = request('kanji_id');
        $radicalId = request('radical_id');
        $similarCount = request('similar_count');

        $sortKey = $this->getSortKey();

        $models = Model::query()
            ->withCount('radicals', 'similar')
            ->when($radicalId, function (Builder $query) use ($radicalId) {
                return $query->whereHas('radicals', function (Builder $query) use ($radicalId) {
                    $query->where('radical_id', $radicalId);
                });
            })
            ->when($kanjiId, function (Builder $query) use ($kanjiId) {
                return $query->whereHas('similar', function (Builder $query) use ($kanjiId) {
                    $query->where('similar_id', $kanjiId);
                });
            })
            ->when(null !== $similarCount, function (Builder $query) use ($similarCount) {
                return $similarCount
                    ? $query->has('similar')
                    : $query->doesntHave('similar');
            })
            ->when($q, fn (Builder $query) => $query->where('meaning', 'LIKE', "%{$q}%"))
            ->orderBy($sortKey, $this->getSortDir())
            ->when($sortKey === 'level', fn (Builder $query) => $query->orderBy('meaning'))
            ->paginate();

        return view($this->view, ['models' => $models]);
    }

    protected function requestDataForModel()
    {
        $data = parent::requestDataForModel();

        if (!empty($data['similar_kanji'])) {
            $characters = $this->splitKanjiCharacters($data['similar_kanji']);

            $data['similar'] = Model::whereIn('character', $characters)
                ->get(['id'])
                ->modelKeys();

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
     * @param Model $model
     */
    protected function updateModel($model)
    {
        parent::updateModel($model);

        $model->radicals()->sync(request('radicals', []));

        $result = $model->similar()->sync(request('similar', []));

        $ids = $model->similar->pluck('id')->push($model->id);

        $model->similar->each(function (Model $item) use ($ids) {
            $item->similar()->sync($ids->filter(fn ($id) => $item->id !== $id));
        });

        $detached = Model::find($result['detached']);

        $detached->each(function (Model $item) use ($ids) {
            $item->similar()->detach();
        });
    }
}
