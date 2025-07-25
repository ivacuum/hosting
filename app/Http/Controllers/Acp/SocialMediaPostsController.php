<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\Domain\Sort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class SocialMediaPostsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(SocialMediaPost::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new SocialMediaPost, Sort::asc('published_at'));

        $status = request()->enum('status', SocialMediaPostStatus::class, SocialMediaPostStatus::Queued);

        $models = SocialMediaPost::query()
            ->with('photo')
            ->when($status, fn (Builder $query) => $query->where('status', $status))
            ->orderBy(match ($sort->key) {
                'views',
                'photos_count' => $sort->key,
                default => 'published_at',
            }, $sort->direction->value)
            ->paginate(20);

        return view('acp.social-media-posts.index', [
            'models' => $models,
        ]);
    }

    public function create(SocialMediaPost $socialMediaPost, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($socialMediaPost);
    }

    public function destroy(SocialMediaPost $socialMediaPost, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($socialMediaPost);
    }

    public function edit(SocialMediaPost $socialMediaPost, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($socialMediaPost);
    }

    public function show(SocialMediaPost $socialMediaPost, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($socialMediaPost);
    }
}
