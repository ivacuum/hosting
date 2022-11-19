<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\City;
use App\Domain\Sort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Cities extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(City::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new City, Sort::asc('title'));

        $countryId = request('country_id');

        $models = City::query()
            ->with('country')
            ->withCount('trips')
            ->when($countryId, fn (Builder $query) => $query->where('country_id', $countryId))
            ->orderBy(match ($sort->key) {
                'trips_count',
                'views' => $sort->key,
                default => City::titleField(),
            }, $sort->direction->value)
            ->paginate();

        return view('acp.cities.index', ['models' => $models]);
    }

    public function create(City $city, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($city);
    }

    public function destroy(City $city, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($city);
    }

    public function edit(City $city, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($city);
    }

    public function show(City $city, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($city, ['trips']);
    }
}
