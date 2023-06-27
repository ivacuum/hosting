<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\Sort;
use App\Gig;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class GigsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Gig::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Gig, Sort::desc('date'));

        $models = Gig::query()
            ->orderBy(match ($sort->key) {
                'views' => $sort->key,
                default => 'date',
            }, $sort->direction->value)
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
