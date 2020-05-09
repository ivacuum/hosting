<?php namespace App\Http\Controllers\Acp;

use App\Vocabulary as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Vocabularies extends Controller
{
    protected $sortDir = 'asc';
    protected $sortKey = 'level';
    protected $sortableKeys = ['level', 'meaning'];

    public function index()
    {
        $q = request('q');
        $sentences = request('sentences');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::orderBy($sortKey, $sortDir)
            ->when($sortKey === 'level', fn (Builder $query) => $query->orderBy('meaning'))
            ->when(null !== $sentences, fn (Builder $query) => $query->where('sentences', $sentences ? '<>' : '=', ''))
            ->when($q, fn (Builder $query) => $query->where('meaning', 'LIKE', "%{$q}%"))
            ->paginate();

        return view($this->view, ['models' => $models]);
    }

    protected function requestDataForModel()
    {
        $data = parent::requestDataForModel();

        if (isset($data['sentences'])) {
            $data['sentences'] = str_replace(["\r", "。\n\n", "？\n\n", "！\n\n"], ['', "。\n", "？\n", "！\n"], $data['sentences']);
        }

        return $data;
    }
}
