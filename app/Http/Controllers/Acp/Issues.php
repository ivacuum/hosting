<?php namespace App\Http\Controllers\Acp;

use App\Issue as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Issues extends Controller
{
    protected $api_only = true;

    public function index()
    {
        $status = request('status');
        $user_id = request('user_id');

        [$sort_key, $sort_dir] = $this->getSortParams();

        $models = Model::with('user:id,login')
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->unless(null === $status, function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->orderBy($sort_key, $sort_dir)
            ->paginate(50)
            ->withPath(path("{$this->class}@index"));

        return $this->modelResourceCollection($models);
    }
}
