<?php namespace App\Http\Controllers\Acp;

use App\Photo as Model;
use Ivacuum\Generic\Controllers\Acp\UsesLivewire;

class Photos extends AbstractController implements UsesLivewire
{
    protected $sortableKeys = ['id', 'views'];

    public function index()
    {
        $filter = request('filter');
        $onPage = request('on_page');

        $models = Model::query()
            ->with('tags')
            ->forTrip(request('trip_id'))
            ->applyFilter($filter)
            ->forTag(request('tag_id'))
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate($onPage);

        return view($this->view, [
            'filter' => $filter,
            'models' => $models,
        ]);
    }
}
