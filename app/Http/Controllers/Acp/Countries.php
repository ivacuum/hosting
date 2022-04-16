<?php namespace App\Http\Controllers\Acp;

use App\Country as Model;
use Illuminate\Validation\Rule;

class Countries extends AbstractController
{
    protected $sortDir = 'asc';
    protected $sortKey = 'title';
    protected $sortableKeys = ['title', 'cities_count', 'trips_count', 'views'];
    protected $showWithCount = ['cities', 'trips'];

    public function index()
    {
        $models = Model::query()
            ->withCount(['cities', 'trips'])
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate(500);

        return view($this->view, ['models' => $models]);
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
                Rule::unique('countries', 'slug')->ignore($model, 'slug'),
            ],
            'title_ru' => 'required',
            'title_en' => 'required',
        ];
    }
}
