<?php namespace App\Http\Controllers\Acp;

use App\Gig as Model;
use Illuminate\Validation\Rule;

class Gigs extends AbstractController
{
    protected $sortKey = 'date';
    protected $sortableKeys = ['date', 'views'];

    public function index()
    {
        $models = Model::query()
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate(500);

        return view($this->view, ['models' => $models]);
    }

    protected function newModelDefaults($model)
    {
        /** @var Model $model */
        $model->date = now()->startOfDay();
        $model->slug = 'artist.' . now()->year;
        $model->status = Model::STATUS_HIDDEN;

        return $model;
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
            'date' => 'required|date',
            'city_id' => 'required|integer|min:1',
            'title_ru' => 'required',
            'title_en' => 'required',
            'artist_id' => 'required|integer|min:1',
        ];
    }
}
