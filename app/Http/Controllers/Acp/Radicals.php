<?php namespace App\Http\Controllers\Acp;

use App\Kanji;
use App\Radical as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Radicals extends Controller
{
    protected $sortDir = 'asc';
    protected $sortKey = 'level';
    protected $sortableKeys = ['level', 'meaning', 'kanjis_count'];
    protected $showWithCount = ['kanjis'];

    public function index()
    {
        $q = request('q');
        $kanjiId = request('kanji_id');
        $kanjisCount = request('kanjis_count');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::withCount('kanjis')
            ->orderBy($sortKey, $sortDir)
            ->when($kanjiId, function (Builder $query) use ($kanjiId) {
                return $query->whereHas('kanjis', function (Builder $query) use ($kanjiId) {
                    $query->where('kanji_id', $kanjiId);
                });
            })
            ->when(null !== $kanjisCount, function (Builder $query) use ($kanjisCount) {
                return $kanjisCount
                    ? $query->has('kanjis')
                    : $query->doesntHave('kanjis');
            })
            ->when($sortKey === 'level', function (Builder $query) {
                return $query->orderBy('meaning');
            })
            ->when($q, function (Builder $query) use ($q) {
                return $query->where('meaning', 'LIKE', "%{$q}%");
            })
            ->paginate()
            ->withPath(path([self::class, 'index']));

        return view($this->view, ['models' => $models]);
    }

    protected function requestDataForModel()
    {
        $data = parent::requestDataForModel();

        if (!empty($data['kanji_string'])) {
            // Объединение кандзи из строки и списка галочек
            // Приведение к числам для правильного объединения
            $ids = Kanji::whereIn('character', $this->splitKanjiCharacters($data['kanji_string']))
                ->get(['id'])
                ->modelKeys();

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

        $model->kanjis()->sync(request('kanjis', []));
    }
}
