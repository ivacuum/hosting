<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Photo;
use App\Scope\PhotoApplyFilterScope;
use App\Scope\PhotoForTagScope;
use App\Scope\PhotoForTripScope;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Photos extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Photo::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(
            new Photo,
            ['id', 'views'],
        );

        $filter = request('filter');
        $onPage = request('on_page');

        $models = Photo::query()
            ->with('tags')
            ->tap(new PhotoForTripScope(request('trip_id')))
            ->tap(new PhotoApplyFilterScope($filter))
            ->tap(new PhotoForTagScope(request('tag_id')))
            ->orderBy($sortKey, $sortDir)
            ->paginate($onPage);

        return view('acp.photos.index', [
            'filter' => $filter,
            'models' => $models,
        ]);
    }

    public function create(Photo $photo, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($photo);
    }

    public function destroy(Photo $photo, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($photo);
    }

    public function edit(Photo $photo, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($photo);
    }

    public function show(Photo $photo, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($photo);
    }
}
