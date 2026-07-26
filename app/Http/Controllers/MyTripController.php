<?php

namespace App\Http\Controllers;

use App\Action\RedirectAfterUpdateAction;
use App\Domain\Life\Models\Trip;
use App\Http\Requests\TripStoreForm;
use App\Http\Requests\TripUpdateForm;
use App\Utilities\CityHelper;
use Illuminate\Routing\Attributes\Controllers\Authorize;

class MyTripController
{
    public function index()
    {
        $models = Trip::query()
            ->with('user')
            ->withCount('comments', 'photos')
            ->whereBelongsTo(request()->user())
            ->orderByDesc('date_start')
            ->paginate(40, Trip::COLUMNS_LIST);

        return view('my.trips.index', ['models' => $models]);
    }

    public function create(Trip $trip)
    {
        return view('my.trips.create', ['model' => $trip]);
    }

    #[Authorize('delete', 'trip')]
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return redirect(path([MyTripController::class, 'index']));
    }

    #[Authorize('update', 'trip')]
    public function edit(Trip $trip)
    {
        return view('my.trips.edit', ['model' => $trip]);
    }

    public function store(TripStoreForm $request, CityHelper $cityHelper)
    {
        /** @var \App\User $user */
        $user = $request->user();
        $city = $cityHelper->findByIdOrFail($request->cityId);

        $trip = new Trip;
        $trip->slug = $request->slug;
        $trip->status = $request->status;
        $trip->city_id = $city->id;
        $trip->user_id = $user->id;
        $trip->markdown = $request->markdown;
        $trip->title_en = $city->title_en;
        $trip->title_ru = $city->title_ru;
        $trip->date_end = $request->dateEnd;
        $trip->date_start = $request->dateStart;
        $trip->save();

        return redirect(path([MyTripController::class, 'index']));
    }

    #[Authorize('update', 'trip')]
    public function update(
        Trip $trip,
        CityHelper $cityHelper,
        TripUpdateForm $request,
        RedirectAfterUpdateAction $redirectAfterUpdate,
    ) {
        $city = $cityHelper->findByIdOrFail($request->cityId);

        $trip->slug = $request->slug;
        $trip->status = $request->status;
        $trip->city_id = $city->id;
        $trip->markdown = $request->markdown;
        $trip->title_en = $request->titleEn;
        $trip->title_ru = $request->titleRu;
        $trip->date_end = $request->dateEnd;
        $trip->date_start = $request->dateStart;

        $trip->save();

        return $redirectAfterUpdate->execute($trip);
    }
}
