<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\Sort;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Trips extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Trip::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Trip, Sort::desc('date_start'));

        $q = request('q');
        $status = request('status');
        $cityId = request('city_id');
        $userId = request('user_id');
        $countryId = request('country_id');

        $models = Trip::with('user')
            ->withCount('comments', 'photos')
            ->when($cityId, fn (Builder $query) => $query->where('city_id', $cityId))
            ->when($countryId, fn (Builder $query) => $query->whereRelation('city.country', 'country_id', $countryId))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->unless(null === $status, fn (Builder $query) => $query->where('status', $status))
            ->when($q,
                fn (Builder $query) => $query->where('id', $q)
                    ->orWhere(Trip::titleField(), 'LIKE', "%{$q}%")
                    ->orWhere('slug', 'LIKE', "%{$q}%"))
            ->orderBy(match ($sort->key) {
                'views',
                'comments_count',
                'photos_count' => $sort->key,
                default => 'date_start',
            }, $sort->direction->value)
            ->paginate(50);

        return view('acp.trips.index', ['models' => $models]);
    }

    public function create(Trip $trip, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($trip);
    }

    public function destroy(Trip $trip, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($trip);
    }

    public function edit(Trip $trip, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($trip);
    }

    public function show(Trip $trip, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($trip, ['comments', 'photos']);
    }
}
