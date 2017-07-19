<?php namespace App\Http\Controllers\Acp;

use App\Gig as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Gigs extends Controller
{
    protected $sort_key = 'date';
    protected $sortable_keys = ['date', 'views'];

    public function index()
    {
        list($sort_key, $sort_dir) = $this->getSortParams();

        $models = Model::orderBy($sort_key, $sort_dir)->get();

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
                'bail',
                'required',
                Rule::unique('artists', 'slug')->ignore($model->id ?? null),
                Rule::unique('cities', 'slug')->ignore($model->id ?? null),
                Rule::unique('gigs', 'slug')->ignore($model->id ?? null),
                Rule::unique('trips', 'slug')->ignore($model->id ?? null),
            ],
            'date' => 'required|date',
            'city_id' => 'required|integer|min:1',
            'title_ru' => 'required',
            'title_en' => 'required',
            'artist_id' => 'required|integer|min:1',
        ];
    }
}
