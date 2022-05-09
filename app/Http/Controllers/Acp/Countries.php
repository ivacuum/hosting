<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Country;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Countries extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Country::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(
            new Country,
            ['title', 'cities_count', 'trips_count', 'views'],
            'asc',
            'title',
        );

        $models = Country::query()
            ->withCount(['cities', 'trips'])
            ->orderBy($sortKey, $sortDir)
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
