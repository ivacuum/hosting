<?php namespace App\Http\Controllers;

use App\Comment;
use App\Domain\Locale;
use App\Domain\TorrentStatus;
use App\Http\Requests\TorrentsIndexForm;
use App\SearchSynonym;
use App\Torrent;
use Foolz\SphinxQL\SphinxQL;
use Illuminate\Database\Eloquent\Builder;

class Torrents extends Controller
{
    public function index(TorrentsIndexForm $request)
    {
        $q = $request->searchQuery();
        $category = $request->category();
        $fulltext = $request->isFulltextSearch();
        $categoryId = $request->categoryId();

        $torrents = Torrent::query();

        if ($q) {
            $ids = Torrent::search($q, function (SphinxQL $builder) use ($categoryId, $fulltext, $q) {
                $builder = $builder->match($fulltext ? '*' : 'title', SearchSynonym::addSynonymsToQuery($q), true);

                if ($categoryId) {
                    $builder = $builder->where('category_id', '=', $categoryId);
                }

                return $builder->execute();
            })->raw();

            event(new \App\Events\Stats\TorrentSearched);

            $torrents = $torrents->whereIn('id', \Arr::pluck($ids, 'id'));
        }

        $torrents = $torrents->published()
            ->orderByDesc('registered_at')
            ->when(!$q && $category, function (Builder $query) use ($categoryId) {
                $ids = \TorrentCategoryHelper::selfAndDescendantsIds($categoryId);

                event(new \App\Events\Stats\TorrentFilteredByCategory);

                return $query->whereIn('category_id', $ids);
            })
            ->simplePaginate(25, Torrent::LIST_COLUMNS);

        return view('torrents.index', [
            'q' => $q,
            'tree' => \TorrentCategoryHelper::tree(),
            'stats' => Torrent::statsByCategories(),
            'fulltext' => $fulltext,
            'torrents' => $torrents,
            'categoryId' => $categoryId,
        ]);
    }

    public function comments()
    {
        $comments = Comment::with('rel', 'user')
            ->byType('Torrent')
            ->published()
            ->orderByDesc('created_at')
            ->take(50)
            ->get();

        return view('torrents.comments', ['comments' => $comments]);
    }

    public function faq()
    {
        event(new \App\Events\Stats\TorrentFaqViewed);

        return view('torrents.faq');
    }

    public function magnet(Torrent $torrent)
    {
        $torrent->incrementClicks();

        if (null === request()->user()) {
            event(new \App\Events\Stats\TorrentMagnetGuestClicked);
        }

        return response()->noContent();
    }

    public function my()
    {
        $user = request()->user();

        $torrents = Torrent::query()
            ->select(Torrent::LIST_COLUMNS)
            ->whereBelongsTo($user)
            ->where('status', TorrentStatus::Published)
            ->withCount('commentsPublished AS comments')
            ->orderByDesc('registered_at')
            ->simplePaginate(null, ['id']);

        return view('torrents.my', ['torrents' => $torrents]);
    }

    public function show(Torrent $torrent)
    {
        abort_if(\App::getLocale() === Locale::Eng->value, 404);
        abort_if($torrent->isNotPublished(), 404);

        \Breadcrumbs::push($torrent->shortTitle());

        event(new \App\Events\Stats\TorrentViewed($torrent->id));

        return view('torrents.show', [
            'torrent' => $torrent,
            'comments' => $torrent->commentsPublished()->with('user')->orderBy('created_at')->get(),
            'metaTitle' => $torrent->title,
        ]);
    }
}
