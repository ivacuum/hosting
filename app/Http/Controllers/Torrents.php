<?php namespace App\Http\Controllers;

use App\Comment;
use App\Services\Rto;
use App\Torrent;
use Carbon\Carbon;
use Illuminate\Support\HtmlString;

class Torrents extends Controller
{
    protected $list_columns = ['id', 'category_id', 'rto_id', 'title', 'size', 'info_hash', 'announcer', 'clicks', 'views', 'registered_at'];

    public function index()
    {
        $q = $this->request->input('q');
        $category = null;
        $category_id = $this->request->input('category_id');

        abort_if($category_id && is_null($category = \TorrentCategoryHelper::find($category_id)), 404);

        \Breadcrumbs::push(trans($this->view));

        $torrents = Torrent::orderBy('registered_at', 'desc');

        if (!is_null($category)) {
            $ids = \TorrentCategoryHelper::selfAndDescendantsIds($category_id, $category);

            event(new \App\Events\Stats\TorrentFilteredByCategory);

            $torrents = $torrents->whereIn('category_id', $ids);
        }

        $torrents = $this->applySearchQuery($q, $torrents);
        $torrents = $torrents->simplePaginate(null, $this->list_columns)
            ->appends(compact('category_id', 'q'));

        $tree = \TorrentCategoryHelper::tree();
        $stats = Torrent::statsByCategories();

        return view($this->view, compact('category_id', 'q', 'torrents', 'tree', 'stats'));
    }

    public function add()
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push(trans($this->view));

        return view($this->view);
    }

    public function addPost(Rto $rto)
    {
        $input = $this->request->input('input');
        $category_id = $this->request->input('category_id');

        $this->validate($this->request, [
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
            'seeders' => $data['seeders'],
            'user_id' => $this->request->user()->id,
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'category_id' => $category_id,
            'registered_at' => Carbon::now(),
        ]);

        event(new \App\Events\Stats\TorrentAdded);

        return redirect($torrent->www());
    }

    public function comments()
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push('Последние комментарии');

        $comments = Comment::with('rel', 'user')
            ->byType('Torrent')
            ->orderBy('id', 'desc')
            ->take(50)
            ->get();

        return view($this->view, compact('comments'));
    }

    public function faq()
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push(trans('torrents.faq'));

        event(new \App\Events\Stats\TorrentFaqViewed);

        return view($this->view);
    }

    public function magnet(Torrent $torrent)
    {
        $torrent->timestamps = false;
        $torrent->increment('clicks');
        $torrent->timestamps = true;

        event(new \App\Events\Stats\TorrentMagnetClicked);

        if (is_null($this->request->user())) {
            event(new \App\Events\Stats\TorrentMagnetGuestClicked);
        }

        return 'OK';
    }

    public function my()
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push(trans('torrents.my'));

        $user = $this->request->user();

        $torrents = Torrent::select($this->list_columns)
            ->where('user_id', $user->id)
            ->withCount('commentsPublished as comments')
            ->orderBy('registered_at', 'desc')
            ->simplePaginate(null, ['id']);

        return view($this->view, compact('torrents'));
    }

    public function promo()
    {
        event(new \App\Events\Stats\TorrentPromoViewed);

        return view($this->view);
    }

    public function torrent(Torrent $torrent)
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push($torrent->title);

        event(new \App\Events\Stats\TorrentViewed($torrent->id));

        $comments = $torrent->commentsPublished()->with('user')->orderBy('id')->get();

        $meta_title = $torrent->title;

        return view($this->view, compact('comments', 'meta_title', 'torrent'));
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
