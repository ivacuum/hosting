<?php namespace App\Http\Controllers\Acp;

use App\Vocabulary as Model;
use Illuminate\Database\Eloquent\Builder;

class Vocabularies extends AbstractController
{
    protected $sortDir = 'asc';
    protected $sortKey = 'level';
    protected $sortableKeys = ['level', 'meaning'];

    public function index()
    {
        $q = request('q');
        $sentences = request('sentences');

        $sortKey = $this->getSortKey();

        $models = Model::query()
            ->when(null !== $sentences, fn (Builder $query) => $query->where('sentences', $sentences ? '<>' : '=', ''))
            ->when($q, fn (Builder $query) => $query->where('meaning', 'LIKE', "%{$q}%"))
            ->orderBy($sortKey, $this->getSortDir())
            ->when($sortKey === 'level', fn (Builder $query) => $query->orderBy('meaning'))
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
