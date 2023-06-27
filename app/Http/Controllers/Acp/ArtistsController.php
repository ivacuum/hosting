<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Artist;
use App\Domain\Sort;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class ArtistsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Artist::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Artist, Sort::asc('title'));

        $models = Artist::query()
            ->orderBy('title', $sort->direction->value)
            ->paginate(500);

        return view('acp.artists.index', ['models' => $models]);
    }

    public function create(Artist $artist, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($artist);
    }

    public function destroy(Artist $artist, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($artist);
    }

    public function edit(Artist $artist, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($artist);
    }

    public function show(Artist $artist, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($artist);
    }
}
