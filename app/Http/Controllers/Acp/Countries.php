<?php namespace App\Http\Controllers\Acp;

use App\Country as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Countries extends Controller
{
    protected $sortDir = 'asc';
    protected $sortKey = 'title';
    protected $sortableKeys = ['title', 'cities_count', 'trips_count', 'views'];
    protected $showWithCount = ['cities', 'trips'];

    public function index()
    {
        [$sortKey, $sortDir] = $this->getSortParams();

        $sortKey = $sortKey === 'title' ? Model::titleField() : $sortKey;

        $models = Model::withCount(['cities', 'trips'])
            ->orderBy($sortKey, $sortDir)
            ->paginate(500)
            ->withPath(path([self::class, 'index']));

        return view($this->view, [
            'models' => $models,
        ]);
    }

    /**
     * @param Model|null $model
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
