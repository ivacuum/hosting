<?php namespace App\Http\Controllers;

use App\Comment;
use App\Domain\Locale;
use App\Domain\MagnetStatus;
use App\Http\Requests\TorrentsIndexForm;
use App\Magnet;
use App\SearchSynonym;
use Foolz\SphinxQL\SphinxQL;
use Illuminate\Database\Eloquent\Builder;

class MagnetsController extends Controller
{
    public function index(TorrentsIndexForm $request)
    {
        $q = $request->searchQuery();
        $category = $request->category();
        $fulltext = $request->isFulltextSearch();
        $categoryId = $request->categoryId();

        $magnets = Magnet::query();

        if ($q) {
            $ids = Magnet::search($q, function (SphinxQL $builder) use ($categoryId, $fulltext, $q) {
                $builder = $builder->match($fulltext ? '*' : 'title', SearchSynonym::addSynonymsToQuery($q), true);

                if ($categoryId) {
                    $builder = $builder->where('category_id', '=', $categoryId);
                }

                return $builder->execute();
            })->raw();

            event(new \App\Events\Stats\TorrentSearched);

            $magnets = $magnets->whereIn('id', \Arr::pluck($ids, 'id'));
        }

        $magnets = $magnets->published()
            ->orderByDesc('registered_at')
            ->when(!$q && $category, function (Builder $query) use ($categoryId) {
                $ids = \TorrentCategoryHelper::selfAndDescendantsIds($categoryId);

                event(new \App\Events\Stats\TorrentFilteredByCategory);

                return $query->whereIn('category_id', $ids);
            })
            ->simplePaginate(25, Magnet::LIST_COLUMNS);

        return view('magnets.index', [
            'q' => $q,
            'tree' => \TorrentCategoryHelper::tree(),
            'stats' => Magnet::statsByCategories(),
            'magnets' => $magnets,
            'fulltext' => $fulltext,
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

        if (null === request()->user()) {
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
            ->where('status', MagnetStatus::Published)
            ->withCount('commentsPublished AS comments')
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
            'comments' => $magnet->commentsPublished()->with('user')->orderBy('created_at')->get(),
            'metaTitle' => $magnet->title,
        ]);
    }
}
