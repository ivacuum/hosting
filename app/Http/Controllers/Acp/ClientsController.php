<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class ClientsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Client::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Client);

        $models = Client::query()
            ->orderBy('id', $sort->direction->value)
            ->paginate();

        return view('acp.clients.index', ['models' => $models]);
    }

    public function create(Client $client, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($client);
    }

    public function destroy(Client $client, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($client);
    }

    public function edit(Client $client, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($client);
    }

    public function show(Client $client, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($client, ['domains']);
    }
}
