<?php namespace App\Http\Controllers\Acp;

use App\City as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class Cities extends AbstractController
{
    protected $sortDir = 'asc';
    protected $sortKey = 'title';
    protected $sortableKeys = ['title', 'trips_count', 'views'];
    protected $showWithCount = ['trips'];
    protected $reactiveFields = ['country_id', 'title_en', 'title_ru', 'lat', 'lon'];

    public function index()
    {
        $countryId = request('country_id');

        $models = Model::query()
            ->with('country')
            ->withCount('trips')
            ->when($countryId, fn (Builder $query) => $query->where('country_id', $countryId))
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate();

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
                'bail',
                'required',
                Rule::unique('artists', 'slug')->ignore($model->id ?? null),
                Rule::unique('cities', 'slug')->ignore($model->id ?? null),
                Rule::unique('gigs', 'slug')->ignore($model->id ?? null),
                Rule::unique('trips', 'slug')
                    ->where('user_id', 1)
                    ->ignore($model->id ?? null),
            ],
            'title_ru' => 'required',
            'title_en' => 'required',
            'country_id' => 'required|integer|min:1',
        ];
    }
}
