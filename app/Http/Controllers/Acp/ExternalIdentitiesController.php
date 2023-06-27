<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToShowAction;
use App\ExternalIdentity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class ExternalIdentitiesController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(ExternalIdentity::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new ExternalIdentity);

        $userId = request('user_id');
        $provider = request('provider');

        $models = ExternalIdentity::query()
            ->with('user')
            ->unless(null === $userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->when(null === $userId, fn (Builder $query) => $query->where('user_id', '<>', 0))
            ->when($provider, fn (Builder $query) => $query->where('provider', $provider))
            ->orderBy('id', $sort->direction->value)
            ->paginate();

        return view('acp.external-identities.index', ['models' => $models]);
    }

    public function destroy(ExternalIdentity $externalIdentity, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($externalIdentity);
    }

    public function show(ExternalIdentity $externalIdentity, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($externalIdentity);
    }
}
