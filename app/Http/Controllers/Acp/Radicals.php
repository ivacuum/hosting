<?php namespace App\Http\Controllers\Acp;

use App\Kanji;
use App\Radical as Model;
use Illuminate\Database\Eloquent\Builder;

class Radicals extends AbstractController
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

        $sortKey = $this->getSortKey();

        $models = Model::withCount('kanjis')
            ->when($kanjiId,
                fn (Builder $query) => $query->whereHas('kanjis',
                    fn (Builder $query) => $query->where('kanji_id', $kanjiId)))
            ->when(null !== $kanjisCount,
                fn (Builder $query) => $kanjisCount
                    ? $query->has('kanjis')
                    : $query->doesntHave('kanjis'))
            ->when($q, fn (Builder $query) => $query->where('meaning', 'LIKE', "%{$q}%"))
            ->orderBy($sortKey, $this->getSortDir())
            ->when($sortKey === 'level', fn (Builder $query) => $query->orderBy('meaning'))
            ->paginate();

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
                array_map(fn ($val) => $val + 0, $data['kanjis'] ?? [])
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
     * @param Model $model
     */
    protected function updateModel($model)
    {
        parent::updateModel($model);

        $model->kanjis()->sync(request('kanjis', []));
    }
}
