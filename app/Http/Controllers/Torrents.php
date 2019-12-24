<?php namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\TorrentStoreRequest;
use App\Http\Resources\TorrentCollection;
use App\SearchSynonym;
use App\Services\Rto;
use App\Services\RtoMagnetNotFoundException;
use App\Services\RtoTopicDuplicateException;
use App\Services\RtoTopicNotFoundException;
use App\Torrent;
use Foolz\SphinxQL\SphinxQL;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class Torrents extends Controller
{
    public function index()
    {
        $q = request('q');
        $q = mb_strlen($q) > 1 ? $q : null;
        $category = null;
        $fulltext = request('fulltext');
        $categoryId = request('category_id');

        abort_if($categoryId && null === $category = \TorrentCategoryHelper::find($categoryId), 404);

        $torrents = Torrent::query();

        if ($q) {
            $ids = Torrent::search($q, function (SphinxQL $builder) use ($categoryId, $fulltext, $q) {
                $builder = $builder->match($fulltext ? '*' : 'title', SearchSynonym::addSynonymsToQuery($q), true);

                if ($categoryId) {
                    $builder = $builder->where('category_id', '=', (int) $categoryId);
                }

                return $builder->execute();
            })->raw();

            event(new \App\Events\Stats\TorrentSearched);

            $torrents = $torrents->whereIn('id', \Arr::pluck($ids, 'id'));
        }

        $torrents = $torrents->published()
            ->orderByDesc('registered_at')
            ->when(!$q && null !== $category, function (Builder $query) use ($categoryId) {
                $ids = \TorrentCategoryHelper::selfAndDescendantsIds($categoryId);

                event(new \App\Events\Stats\TorrentFilteredByCategory);

                return $query->whereIn('category_id', $ids);
            })
            ->simplePaginate(25, Torrent::LIST_COLUMNS)
            ->withPath(path([self::class, 'index']));

        if (request()->wantsJson()) {
            return new TorrentCollection($torrents);
        }

        return view($this->view, [
            'q' => $q,
            'tree' => \TorrentCategoryHelper::tree(),
            'stats' => Torrent::statsByCategories(),
            'fulltext' => $fulltext,
            'torrents' => $torrents,
            'categoryId' => $categoryId,
        ]);
    }

    public function create()
    {
        return view($this->view);
    }

    public function comments()
    {
        $comments = Comment::with('rel', 'user')
            ->byType('Torrent')
            ->published()
            ->orderByDesc('created_at')
            ->take(50)
            ->get();

        return view($this->view, ['comments' => $comments]);
    }

    public function faq()
    {
        event(new \App\Events\Stats\TorrentFaqViewed);

        return view($this->view);
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

        $torrents = Torrent::select(Torrent::LIST_COLUMNS)
            ->where('user_id', $user->id)
            ->where('status', Torrent::STATUS_PUBLISHED)
            ->withCount('commentsPublished AS comments')
            ->orderByDesc('registered_at')
            ->simplePaginate(null, ['id'])
            ->withPath(path([self::class, 'my']));

        return view($this->view, ['torrents' => $torrents]);
    }

    public function show(Torrent $torrent)
    {
        \Breadcrumbs::push($torrent->shortTitle());

        event(new \App\Events\Stats\TorrentViewed($torrent->id));

        return view($this->view, [
            'torrent' => $torrent,
            'comments' => $torrent->commentsPublished()->with('user')->orderBy('created_at')->get(),
            'metaTitle' => $torrent->title,
        ]);
    }

    public function store(TorrentStoreRequest $request, Rto $rto)
    {
        $topicId = $request->topicId($rto);

        if ($topicId > 0) {
            $torrent = Torrent::where('rto_id', $topicId)->first();

            if (null !== $torrent) {
                event(new \App\Events\Stats\TorrentDuplicateFound);

                return back()
                    ->withInput()
                    ->with('message', new HtmlString('Данная раздача уже <a class="link" href="' . $torrent->www() . '">присутствует на сайте</a>. Попробуйте добавить другую.'));
            }
        }

        try {
            $data = $rto->torrentData($topicId);
        } catch (\Throwable $e) {
            $message = 'Ввод не распознан, попробуйте другую ссылку или хэш';

            if ($e instanceof RtoMagnetNotFoundException) {
                $message = 'Магнет-ссылка не найдена в раздаче, попробуйте другую ссылку';
            } elseif ($e instanceof RtoTopicDuplicateException) {
                $message = 'Раздача закрыта как повторная, попробуйте другую ссылку';
            } elseif ($e instanceof RtoTopicNotFoundException) {
                $message = 'Раздача не найдена, попробуйте другую ссылку';
            }

            return back()
                ->withInput()
                ->withErrors(['input' => $message]);
        }

        $torrent = new Torrent;
        $torrent->html = $data->getBody();
        $torrent->size = $data->getSize();
        $torrent->title = $data->getTitle();
        $torrent->clicks = 0;
        $torrent->rto_id = $data->getId();
        $torrent->status = Torrent::STATUS_PUBLISHED;
        $torrent->user_id = request()->user()->id;
        $torrent->info_hash = $data->getInfoHash();
        $torrent->announcer = $data->getAnnouncer();
        $torrent->category_id = $request->categoryId();
        $torrent->registered_at = now();
        $torrent->related_query = '';
        $torrent->save();

        return redirect($torrent->www());
    }

    public function vue()
    {
        return view('magnets-spa');
    }

    public function vueShow(Torrent $torrent)
    {
        if (!request()->expectsJson()) {
            return view('magnets-spa');
        }

        event(new \App\Events\Stats\TorrentViewed($torrent->id));

        $torrent->setRelation('comments', $torrent->commentsPublished()->with('user')->orderBy('created_at')->get());

        return new \App\Http\Resources\Torrent($torrent);
    }
}
