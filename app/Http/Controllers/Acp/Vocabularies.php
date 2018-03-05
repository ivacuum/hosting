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
        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::orderBy($sort_key, $sort_dir)
            ->when($sort_key === 'level', function (Builder $query) {
                return $query->orderBy('meaning');
            })
            ->paginate()
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('models'));
    }
}
