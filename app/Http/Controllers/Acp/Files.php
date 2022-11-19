<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Files extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(File::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new File);

        $models = File::query()
            ->orderBy(match ($sort->key) {
                'size',
                'downloads' => $sort->key,
                default => 'id',
            }, $sort->direction->value)
            ->paginate();

        return view('acp.files.index', ['models' => $models]);
    }

    public function create(File $file, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($file);
    }

    public function destroy(File $file, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($file);
    }

    public function edit(File $file, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($file);
    }

    public function show(File $file, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($file);
    }
}
