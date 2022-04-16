<?php namespace App\Http\Controllers\Acp;

use App\City as Model;
use App\Rules\LifeSlug;
use Illuminate\Database\Eloquent\Builder;

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
            'slug' => LifeSlug::rules($model),
            'title_ru' => 'required',
            'title_en' => 'required',
            'country_id' => 'required|integer|min:1',
        ];
    }
}
