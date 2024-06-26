<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToShowAction;
use App\Email;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class EmailsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Email::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Email);

        $userId = request('user_id');

        $models = Email::query()
            ->with('user')
            ->unless($userId === null, fn (Builder $query) => $query->where('user_id', $userId))
            ->orderBy(match ($sort->key) {
                'views',
                'clicks' => $sort->key,
                default => 'id',
            }, $sort->direction->value)
            ->paginate(40);

        return view('acp.emails.index', ['models' => $models]);
    }

    public function destroy(Email $email, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($email);
    }

    public function show(Email $email, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($email);
    }
}
