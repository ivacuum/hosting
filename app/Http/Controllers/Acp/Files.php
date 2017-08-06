<?php namespace App\Http\Controllers\Acp;

use App\File as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Files extends Controller
{
    protected $sortable_keys = ['id', 'size', 'downloads'];

    public function index()
    {
        list($sort_key, $sort_dir) = $this->getSortParams();

        $models = Model::orderBy($sort_key, $sort_dir)
            ->paginate();

        return view($this->view, compact('models'));
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'slug' => [
                'required',
                Rule::unique('files', 'slug')->ignore($model->id ?? null),
            ],
            'title' => 'required',
        ];
    }
}
