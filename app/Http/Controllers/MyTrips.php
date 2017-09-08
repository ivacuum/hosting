<?php namespace App\Http\Controllers;

use App\City;
use App\Rules\TripSlug;
use App\Trip;
use Illuminate\Validation\Rule;

class MyTrips extends Controller
{
    public function index()
    {
        $models = Trip::with('user')
            ->withCount('comments', 'photos')
            ->where('user_id', request()->user()->id)
            ->orderBy('date_start', 'desc')
            ->paginate(50, Trip::COLUMNS_LIST);

        return view('my.trips.index', compact('models'));
    }

    public function create()
    {
        $model = new Trip;

        return view('my.trips.create', compact('model'));
    }

    public function destroy()
    {
        return back();
    }

    public function edit($id)
    {
        $model = $this->getTrip($id);

        return view('my.trips.edit', compact('model'));
    }

    public function show($id)
    {
        $model = $this->getTrip($id);

        return view('my.trips.show', compact('model'));
    }

    public function store()
    {
        /* @var \App\User $user */
        $user = request()->user();

        request()->validate($this->rules());

        /* @var City $city */
        $city = City::findOrFail(request('city_id'));

        $model = new Trip;

        $model->slug = request('slug');
        $model->status = request('status');
        $model->city_id = $city->id;
        $model->user_id = $user->id;
        $model->markdown = request('markdown');
        $model->title_en = $city->title_en;
        $model->title_ru = $city->title_ru;
        $model->date_end = request('date_end');
        $model->date_start = request('date_start');

        $model->save();

        return $this->redirectAfterStore($model);
    }

    public function update($id)
    {
        $model = $this->getTrip($id);

        request()->validate($this->rules($model));

        /* @var City $city */
        $city = City::findOrFail(request('city_id'));

        $model->slug = request('slug');
        $model->status = request('status');
        $model->city_id = $city->id;
        $model->markdown = request('markdown');
        $model->title_en = request('title_en');
        $model->title_ru = request('title_ru');
        $model->date_end = request('date_end');
        $model->date_start = request('date_start');

        $model->save();

        return $this->redirectAfterUpdate($model);
    }

    protected function getTrip(int $id): ?Trip
    {
        /* @var Trip $model */
        $model = Trip::findOrFail($id);

        abort_unless($model->user_id === request()->user()->id, 404);

        return $model;
    }

    protected function rules(?Trip $model = null)
    {
        return [
            'slug' => [
                'bail',
                'required',
                new TripSlug,
                Rule::unique('trips', 'slug')
                    ->where('user_id', request()->user()->id)
                    ->ignore($model->id ?? null),
            ],
            'status' => '',
            'city_id' => 'required|integer|min:1',
            'markdown' => '',
            'title_ru' => is_null($model) ? '' : 'required',
            'title_en' => is_null($model) ? '' : 'required',
            'date_end' => 'required|date',
            'date_start' => 'required|date',
        ];
    }
}
