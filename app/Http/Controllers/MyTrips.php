<?php namespace App\Http\Controllers;

use App\Http\Requests\TripStoreRequestRequest;
use App\Http\Requests\TripUpdateRequest;
use App\Trip;

class MyTrips extends Controller
{
    public function index()
    {
        $models = Trip::with('user')
            ->withCount('comments', 'photos')
            ->where('user_id', request()->user()->id)
            ->orderBy('date_start', 'desc')
            ->paginate(50, Trip::COLUMNS_LIST)
            ->withPath(path([self::class, 'index']));

        return view('my.trips.index', ['models' => $models]);
    }

    public function create(Trip $trip)
    {
        return view('my.trips.create', ['model' => $trip]);
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();

        return redirect(path([self::class, 'index']));
    }

    public function edit(Trip $trip)
    {
        return view('my.trips.edit', ['model' => $trip]);
    }

    public function store(TripStoreRequestRequest $request)
    {
        /** @var \App\User $user */
        $user = $request->user();
        $city = \CityHelper::findByIdOrFail($request->input('city_id'));

        $trip = new Trip;

        $trip->slug = $request->input('slug');
        $trip->status = $request->input('status');
        $trip->city_id = $city->id;
        $trip->user_id = $user->id;
        $trip->markdown = $request->input('markdown');
        $trip->title_en = $city->title_en;
        $trip->title_ru = $city->title_ru;
        $trip->date_end = $request->input('date_end');
        $trip->date_start = $request->input('date_start');

        $trip->save();

        return $this->redirectAfterStore($trip);
    }

    public function update(Trip $trip, TripUpdateRequest $request)
    {
        $city = \CityHelper::findByIdOrFail($request->input('city_id'));

        $trip->slug = $request->input('slug');
        $trip->status = $request->input('status');
        $trip->city_id = $city->id;
        $trip->markdown = $request->input('markdown');
        $trip->title_en = $request->input('title_en');
        $trip->title_ru = $request->input('title_ru');
        $trip->date_end = $request->input('date_end');
        $trip->date_start = $request->input('date_start');

        $trip->save();

        return $this->redirectAfterUpdate($trip);
    }
}
