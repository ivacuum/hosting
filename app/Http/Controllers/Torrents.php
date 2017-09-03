<?php namespace App\Http\Controllers;

use App\Comment;
use App\Services\Rto;
use App\Torrent;
use Illuminate\Support\HtmlString;

class Torrents extends Controller
{
    protected $list_columns = ['id', 'category_id', 'rto_id', 'title', 'size', 'info_hash', 'announcer', 'clicks', 'views', 'registered_at'];

    public function index()
    {
        $q = trim(request('q'));
        $category = null;
        $category_id = request('category_id');

        abort_if($category_id && is_null($category = \TorrentCategoryHelper::find($category_id)), 404);

        $torrents = Torrent::published()->orderBy('registered_at', 'desc');

        if (!is_null($category)) {
            $ids = \TorrentCategoryHelper::selfAndDescendantsIds($category_id);

            event(new \App\Events\Stats\TorrentFilteredByCategory);

            $torrents = $torrents->whereIn('category_id', $ids);
        }

        $torrents = $this->applySearchQuery($q, $torrents);
        $torrents = $torrents->simplePaginate(null, $this->list_columns);

        $tree = \TorrentCategoryHelper::tree();
        $stats = Torrent::statsByCategories();

        return view($this->view, compact('category_id', 'q', 'torrents', 'tree', 'stats'));
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
            ->orderBy('id', 'desc')
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

        if (is_null(request()->user())) {
            event(new \App\Events\Stats\TorrentMagnetGuestClicked);
        }

        return 'OK';
    }

    public function my()
    {
        $user = request()->user();

        $torrents = Torrent::select($this->list_columns)
            ->where('user_id', $user->id)
            ->where('status', Torrent::STATUS_PUBLISHED)
            ->withCount('commentsPublished as comments')
            ->orderBy('registered_at', 'desc')
            ->simplePaginate(null, ['id']);

        return view($this->view, compact('torrents'));
    }

    public function show(Torrent $torrent)
    {
        \Breadcrumbs::push($torrent->title);

        event(new \App\Events\Stats\TorrentViewed($torrent->id));

        $comments = $torrent->commentsPublished()->with('user')->orderBy('id')->get();

        $meta_title = $torrent->title;

        return view($this->view, compact('comments', 'meta_title', 'torrent'));
    }

    public function store(Rto $rto)
    {
        $input = request('input');
        $category_id = request('category_id');

        request()->validate([
            'category_id' => 'required|integer|in:'.implode(',', \TorrentCategoryHelper::canPostIds()),
            'input' => 'required',
        ]);

        if (($topic_id = $rto->findTopicId($input)) > 0) {
            $torrent = Torrent::where('rto_id', $topic_id)->first();

            if (!is_null($torrent)) {
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
            'seeders' => $data['seeders'],
            'user_id' => request()->user()->id,
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'category_id' => $category_id,
            'registered_at' => now(),
        ]);

        event(new \App\Events\Stats\TorrentAdded);

        return redirect($torrent->www());
    }

    protected function appendBreadcrumbs()
    {
        $this->middleware('breadcrumbs:torrents.index,torrents');
        $this->middleware('breadcrumbs:torrents.create')->only('create');
        $this->middleware('breadcrumbs:torrents.comments')->only('comments');
        $this->middleware('breadcrumbs:torrents.faq')->only('faq');
        $this->middleware('breadcrumbs:torrents.my')->only('my');
    }

    protected function applySearchQuery($q, $torrents)
    {
        if (mb_strlen($q) > 2) {
            event(new \App\Events\Stats\TorrentSearched);

            return $torrents->where('title', 'LIKE', "%{$q}%");
        }

        return $torrents;
    }
}
