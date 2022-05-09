<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToShowAction;
use App\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Notifications extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Notification::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(
            new Notification,
            defaultSortKey: 'created_at',
        );

        $models = Notification::query()
            ->orderBy($sortKey, $sortDir)
            ->paginate();

        return view('acp.notifications.index', ['models' => $models]);
    }

    public function destroy(Notification $notification, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($notification);
    }

    public function show(Notification $notification, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($notification);
    }
}
