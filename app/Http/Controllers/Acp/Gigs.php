<?php namespace App\Http\Controllers\Acp;

use App\Domain\GigStatus;
use App\Gig as Model;
use App\Rules\LifeSlug;

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
        $model->status = GigStatus::Hidden;

        return $model;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'slug' => LifeSlug::rules($model),
            'date' => 'required|date',
            'city_id' => 'required|integer|min:1',
            'title_ru' => 'required',
            'title_en' => 'required',
            'artist_id' => 'required|integer|min:1',
        ];
    }
}
