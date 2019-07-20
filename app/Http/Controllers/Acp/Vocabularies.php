<?php namespace App\Http\Controllers\Acp;

use App\Vocabulary as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Vocabularies extends Controller
{
    protected $sort_dir = 'asc';
    protected $sort_key = 'level';
    protected $sortable_keys = ['level', 'meaning'];

    public function index()
    {
        $q = request('q');
        $sentences = request('sentences');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::orderBy($sortKey, $sortDir)
            ->when($sortKey === 'level', function (Builder $query) {
                return $query->orderBy('meaning');
            })
            ->when(null !== $sentences, function (Builder $query) use ($sentences) {
                return $query->where('sentences', $sentences ? '<>' : '=', '');
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

        if (isset($data['sentences'])) {
            $data['sentences'] = str_replace(["\r", "。\n\n", "？\n\n", "！\n\n"], ['', "。\n", "？\n", "！\n"], $data['sentences']);
        }

        return $data;
    }
}
