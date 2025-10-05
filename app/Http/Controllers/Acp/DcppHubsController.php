<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\Dcpp\Models\DcppHub;
use App\Domain\Sort;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class DcppHubsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(DcppHub::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new DcppHub, Sort::asc('title'));

        $models = DcppHub::query()
            ->orderBy(match ($sort->key) {
                'clicks' => $sort->key,
                default => 'title',
            }, $sort->direction->value)
            ->get();

        return view('acp.dcpp-hubs.index', ['models' => $models]);
    }

    public function create(DcppHub $dcppHub, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($dcppHub);
    }

    public function destroy(DcppHub $dcppHub, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($dcppHub);
    }

    public function edit(DcppHub $dcppHub, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($dcppHub);
    }

    public function show(DcppHub $dcppHub, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($dcppHub);
    }
}
