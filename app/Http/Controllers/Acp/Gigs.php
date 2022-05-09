<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Gig;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Gigs extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Gig::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(
            new Gig,
            ['date', 'views'],
            'desc',
            'date',
        );

        $models = Gig::query()
            ->orderBy($sortKey, $sortDir)
            ->paginate(500);

        return view('acp.gigs.index', ['models' => $models]);
    }

    public function create(Gig $gig, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($gig);
    }

    public function destroy(Gig $gig, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($gig);
    }

    public function edit(Gig $gig, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($gig);
    }

    public function show(Gig $gig, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($gig);
    }
}
