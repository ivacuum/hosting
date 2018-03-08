<?php namespace App\Http\Controllers\Acp;

use App\Kanji;
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
        $q = request('q');
        $kanji_id = request('kanji_id');
        $kanjis_count = request('kanjis_count');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::withCount('kanjis')
            ->orderBy($sort_key, $sort_dir)
            ->when($kanji_id, function (Builder $query) use ($kanji_id) {
                return $query->whereHas('kanjis', function (Builder $query) use ($kanji_id) {
                    $query->where('kanji_id', $kanji_id);
                });
            })
            ->when(!is_null($kanjis_count), function (Builder $query) use ($kanjis_count) {
                return $kanjis_count
                    ? $query->has('kanjis')
                    : $query->doesntHave('kanjis');
            })
            ->when($sort_key === 'level', function (Builder $query) {
                return $query->orderBy('meaning');
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

        if (!empty($data['kanji_string'])) {
            // Объединение кандзи из строки и списка галочек
            // Приведение к числам для правильного объединения
            $ids = Kanji::whereIn('character', $this->splitKanjiCharacters($data['kanji_string']))
                ->get(['id'])
                ->pluck('id')
                ->toArray();

            $data['kanjis'] = array_merge(
                $ids,
                array_map(function ($val) {
                    return $val + 0;
                }, $data['kanjis'] ?? [])
            );

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

        if (request()->has('kanjis')) {
            $model->kanjis()->sync(request('kanjis'));
        } else {
            $model->kanjis()->detach();
        }
    }
}
