<?php

namespace App\Http\Controllers;

use App\Action\CountMagnetsByCategoriesAction;
use App\Action\SearchForMagnetIdsAction;
use App\Comment;
use App\Domain\Locale;
use App\Domain\MagnetStatus;
use App\Http\Requests\MagnetsIndexForm;
use App\Magnet;
use App\Scope\CommentPublishedScope;
use App\Scope\CommentRelationScope;
use App\Scope\MagnetFilterByCategoryScope;
use App\Scope\MagnetPublishedScope;
use Illuminate\Database\Eloquent\Builder;

class MagnetsController
{
    public function index(MagnetsIndexForm $request, SearchForMagnetIdsAction $searchForMagnetIds)
    {
        $magnets = Magnet::query();

        if ($request->searchQuery) {
            $ids = $searchForMagnetIds
                ->execute($request->searchQuery, $request->categoryId, $request->isFulltextSearch);

            event(new \App\Events\Stats\TorrentSearched);

            $magnets = $magnets->whereIn('id', \Arr::pluck($ids, 'id'));
        }

        $magnets = $magnets->tap(new MagnetPublishedScope)
            ->when(!$request->searchQuery && $request->category, fn (Builder $query) => $query->tap(new MagnetFilterByCategoryScope($request->categoryId)))
            ->orderByDesc('registered_at')
            ->simplePaginate(25, Magnet::LIST_COLUMNS);

        return view('magnets.index', [
            'q' => $request->searchQuery,
            'tree' => \TorrentCategoryHelper::tree(),
            'stats' => resolve(CountMagnetsByCategoriesAction::class)->execute(),
            'magnets' => $magnets,
            'fulltext' => $request->isFulltextSearch,
            'categoryId' => $request->categoryId,
        ]);
    }

    public function comments()
    {
        $comments = Comment::with('rel', 'user')
            ->tap(new CommentRelationScope(new Magnet))
            ->tap(new CommentPublishedScope)
            ->orderByDesc('created_at')
            ->take(50)
            ->get();

        return view('magnets.comments', ['comments' => $comments]);
    }

    public function faq()
    {
        event(new \App\Events\Stats\TorrentFaqViewed);

        return view('magnets.faq');
    }

    public function magnet(Magnet $magnet)
    {
        $magnet->incrementClicks();

        if (request()->user() === null) {
            event(new \App\Events\Stats\TorrentMagnetGuestClicked);
        }

        return response()->noContent();
    }

    public function my()
    {
        $user = request()->user();

        $magnets = Magnet::query()
            ->select(Magnet::LIST_COLUMNS)
            ->whereBelongsTo($user)
            ->tap(new MagnetPublishedScope)
            ->withCount('commentsPublished AS comments_count')
            ->orderByDesc('registered_at')
            ->simplePaginate(null, ['id']);

        return view('magnets.my', ['magnets' => $magnets]);
    }

    public function show(Magnet $magnet)
    {
        abort_if(\App::getLocale() === Locale::Eng->value, 404);
        abort_if($magnet->status !== MagnetStatus::Published, 404);

        \Breadcrumbs::push($magnet->shortTitle());

        event(new \App\Events\Stats\TorrentViewed($magnet->id));

        return view('magnets.show', [
            'magnet' => $magnet,
            'metaTitle' => $magnet->title,
        ]);
    }
}
