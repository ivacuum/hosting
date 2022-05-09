<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Magnet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Magnets extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Magnet::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(
            new Magnet,
            ['id', 'views', 'comments_count', 'clicks'],
        );

        $q = request('q');
        $status = request('status');
        $userId = request('user_id');

        $models = Magnet::query()
            ->with('user')
            ->withCount('comments')
            ->when(null !== $status, fn (Builder $query) => $query->where('status', $status))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->when($q, fn (Builder $query) => $query->where('title', 'LIKE', "%{$q}%"))
            ->orderBy($sortKey, $sortDir)
            ->paginate();

        return view('acp.magnets.index', [
            'models' => $models,
            'status' => $status,
            'user_id' => $userId,
        ]);
    }

    public function destroy(Magnet $magnet, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($magnet);
    }

    public function edit(Magnet $magnet, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($magnet);
    }

    public function show(Magnet $magnet, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($magnet, ['comments']);
    }
}
