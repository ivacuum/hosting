<?php namespace App\Http\Controllers\Acp;

use App\City;
use App\Notifications\TripPublished;
use App\Trip as Model;
use App\User;
use Illuminate\Validation\Rule;

class Trips extends CommonController
{
    protected $show_with_count = ['comments', 'photos'];

    public function index()
    {
        $models = Model::withCount('comments', 'photos')
            ->forCity($this->request->input('city_id'))
            ->forCountry($this->request->input('country_id'))
            ->orderBy('date_start', 'desc')
            ->paginate(100)
            ->appends($this->request->all());

        return view($this->view, compact('models'));
    }

    public function notify($id)
    {
        $model = $this->getModel($id);

        if ($model->status !== Model::STATUS_PUBLISHED) {
            return back()->with('message', 'Для рассылки уведомлений поездка должна быть опубликована');
        }

        $users = User::forAnnouncement()->get();

        \Notification::send($users, new TripPublished($model));

        return back()->with('message', 'Уведомления разосланы пользователям: '.sizeof($users));
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
            'city_id' => 'required|integer|min:1',
            'title_ru' => is_null($model) ? '' : 'required',
            'title_en' => is_null($model) ? '' : 'required',
            'date_end' => 'required|date',
            'date_start' => 'required|date',
        ];
    }

    protected function storeModel()
    {
        $city = City::findOrFail($this->request->input('city_id'));

        $data = $this->request->all();
        $data['title_ru'] = $city->title_ru;
        $data['title_en'] = $city->title_en;

        $model = Model::create($data);

        // TODO
        if (\App::environment('local')) {
            $model->createStoryFile();
        }

        return $model;
    }
}
