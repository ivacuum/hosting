<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Country;
use App\Domain\Sort;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class CountriesController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Country::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Country, Sort::asc('title'));

        $models = Country::query()
            ->withCount(['cities', 'trips'])
            ->orderBy(match ($sort->key) {
                'cities_count',
                'trips_count',
                'views' => $sort->key,
                default => Country::titleField(),
            }, $sort->direction->value)
            ->paginate(500);

        return view('acp.countries.index', ['models' => $models]);
    }

    public function create(Country $country, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($country);
    }

    public function destroy(Country $country, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($country);
    }

    public function edit(Country $country, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($country);
    }

    public function show(Country $country, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($country, ['cities', 'trips']);
    }
}
