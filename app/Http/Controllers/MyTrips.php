<?php namespace App\Http\Controllers;

use App\City;
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
        $data = request()->validate($this->rules());

        /* @var City $city */
        $city = City::findOrFail($data['city_id']);

        $data['user_id'] = $user->id;
        $data['title_en'] = $city->title_en;
        $data['title_ru'] = $city->title_ru;

        $model = Trip::create($data);

        return $this->redirectAfterStore($model);
    }

    public function update($id)
    {
        $model = $this->getTrip($id);

        $data = request()->validate($this->rules($model));

        City::findOrFail($data['city_id']);

        $model->update($data);

        return $this->redirectAfterUpdate($model);
    }

    protected function getTrip(int $id) : ?Trip
    {
        /* @var Trip $model */
        $model = Trip::findOrFail($id);

        abort_unless($model->user_id === request()->user()->id, 404);

        return $model;
    }

    protected function rules(?Trip $model = null)
    {
        return [
            'mail' => 'empty',
            'slug' => [
                'bail',
                'required',
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
