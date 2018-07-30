<?php namespace App\Http\Controllers\Acp;

use App\Country as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Countries extends Controller
{
    protected $api_only = true;
    protected $sort_dir = 'asc';
    protected $sort_key = 'title';
    protected $sortable_keys = ['title', 'cities_count', 'trips_count', 'views'];
    protected $show_with_count = ['cities', 'trips'];

    public function index()
    {
        [$sort_key, $sort_dir] = $this->getSortParams();

        $sort_key = $sort_key === 'title' ? Model::titleField() : $sort_key;

        $models = Model::withCount(['cities', 'trips'])
            ->orderBy($sort_key, $sort_dir)
            ->paginate(500)
            ->withPath(path("{$this->class}@index"));

        return $this->modelResourceCollection($models);
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
                Rule::unique('countries', 'slug')->ignore($model->id ?? null),
            ],
            'title_ru' => 'required',
            'title_en' => 'required',
        ];
    }
}
