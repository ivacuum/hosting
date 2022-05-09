<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\YandexUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class YandexUsers extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(YandexUser::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(
            new YandexUser,
            ['account', 'domains_count'],
            'asc',
            'account',
        );

        $models = YandexUser::query()
            ->withCount('domains')
            ->orderBy($sortKey, $sortDir)
            ->paginate();

        return view('acp.yandex-users.index', ['models' => $models]);
    }

    public function create(YandexUser $yandexUser, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($yandexUser);
    }

    public function destroy(YandexUser $yandexUser, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($yandexUser);
    }

    public function edit(YandexUser $yandexUser, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($yandexUser);
    }

    public function show(YandexUser $yandexUser, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($yandexUser, ['domains']);
    }
}
