<?php namespace App\Http\Controllers;

use App\Comment;
use App\Services\Rto;
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
        $category_id = request('category_id');

        abort_if($category_id && null === $category = \TorrentCategoryHelper::find($category_id), 404);

        if ($q) {
            $ids = Torrent::search($q, function (SphinxQL $builder) use ($category_id, $fulltext, $q) {
                $builder = $builder->match($fulltext ? '*' : 'title', $q);

                if ($category_id) {
                    $builder = $builder->where('category_id', '=', (int) $category_id);
                }

                return $builder->execute();
            })->raw();

            event(new \App\Events\Stats\TorrentSearched);

            $torrents = Torrent::whereIn('id', array_pluck($ids, 'id'));
        } else {
            $torrents = Torrent::query();
        }

        $torrents = $torrents->published()
            ->orderBy('registered_at', 'desc')
            ->when(!$q && null !== $category, function (Builder $query) use ($category_id) {
                $ids = \TorrentCategoryHelper::selfAndDescendantsIds($category_id);

                event(new \App\Events\Stats\TorrentFilteredByCategory);

                return $query->whereIn('category_id', $ids);
            })
            ->simplePaginate(25, Torrent::LIST_COLUMNS)
            ->withPath(path("{$this->class}@index"));

        $tree = \TorrentCategoryHelper::tree();
        $stats = Torrent::statsByCategories();

        return view($this->view, compact('category_id', 'fulltext', 'q', 'torrents', 'tree', 'stats'));
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
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        return view($this->view, compact('comments'));
    }

    public function faq()
    {
        event(new \App\Events\Stats\TorrentFaqViewed);

        return view($this->view);
    }

    public function magnet(Torrent $torrent)
    {
        $torrent->timestamps = false;
        $torrent->increment('clicks');
        $torrent->timestamps = true;

        event(new \App\Events\Stats\TorrentMagnetClicked);

        if (null === request()->user()) {
            event(new \App\Events\Stats\TorrentMagnetGuestClicked);
        }

        return response('', 204);
    }

    public function my()
    {
        $user = request()->user();

        $torrents = Torrent::select(Torrent::LIST_COLUMNS)
            ->where('user_id', $user->id)
            ->where('status', Torrent::STATUS_PUBLISHED)
            ->withCount('commentsPublished as comments')
            ->orderBy('registered_at', 'desc')
            ->simplePaginate(null, ['id'])
            ->withPath(path("{$this->class}@my"));

        return view($this->view, compact('torrents'));
    }

    public function show(Torrent $torrent)
    {
        \Breadcrumbs::push($torrent->shortTitle());

        event(new \App\Events\Stats\TorrentViewed($torrent->id));

        $comments = $torrent->commentsPublished()->with('user')->orderBy('created_at')->get();

        $meta_title = $torrent->title;

        return view($this->view, compact('comments', 'meta_title', 'torrent'));
    }

    public function store(Rto $rto)
    {
        $input = request('input');
        $category_id = request('category_id');

        request()->validate([
            'input' => 'required',
            'category_id' => 'required|integer|in:'.implode(',', \TorrentCategoryHelper::canPostIds()),
        ]);

        if (($topic_id = $rto->findTopicId($input)) > 0) {
            $torrent = Torrent::where('rto_id', $topic_id)->first();

            if (null !== $torrent) {
                event(new \App\Events\Stats\TorrentDuplicateFound);

                return back()
                    ->withInput()
                    ->with('message', new HtmlString('Данная раздача уже <a class="link" href="' . $torrent->www() . '">присутствует на сайте</a>. Попробуйте добавить другую.'));
            }
        }

        if (!is_array($data = $rto->torrentData($input))) {
            return back()
                ->withInput()
                ->withErrors(['input' => $data ?: 'Ввод не распознан, попробуйте другую ссылку или хэш']);
        }

        $torrent = Torrent::create([
            'html' => $data['body'],
            'size' => $data['size'],
            'title' => $data['title'],
            'rto_id' => $data['rto_id'],
            'clicks' => 0,
            'status' => Torrent::STATUS_PUBLISHED,
            'user_id' => request()->user()->id,
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'category_id' => $category_id,
            'registered_at' => now(),
        ]);

        event(new \App\Events\Stats\TorrentAdded);

        return redirect($torrent->www());
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:torrents.index,torrents');
        $this->middleware('breadcrumbs:torrents.create')->only('create');
        $this->middleware('breadcrumbs:torrents.comments')->only('comments');
        $this->middleware('breadcrumbs:torrents.faq')->only('faq');
        $this->middleware('breadcrumbs:torrents.my')->only('my');
    }
}
