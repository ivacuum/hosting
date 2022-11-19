<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\Sort;
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
        $sort = $applyIndexGoods->execute(new Notification, Sort::desc('created_at'));

        $models = Notification::query()
            ->orderBy('created_at', $sort->direction->value)
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
