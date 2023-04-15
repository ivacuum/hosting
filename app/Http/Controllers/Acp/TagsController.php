<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\Sort;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class TagsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Tag::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Tag, Sort::asc('title'));

        $models = Tag::query()
            ->withCount('photos')
            ->orderBy(match ($sort->key) {
                'views',
                'photos_count' => $sort->key,
                default => Tag::titleField(),
            }, $sort->direction->value)
            ->paginate(500);

        return view('acp.tags.index', [
            'models' => $models,
        ]);
    }

    public function create(Tag $tag, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($tag);
    }

    public function destroy(Tag $tag, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($tag);
    }

    public function edit(Tag $tag, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($tag);
    }

    public function show(Tag $tag, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($tag, ['photos']);
    }
}
