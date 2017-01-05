<?php namespace App\Http\Controllers;

use App\Services\Rto;
use App\Torrent;
use Carbon\Carbon;
use Illuminate\Support\HtmlString;

class Torrents extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans($this->view));

        $q = $this->request->input('q');

        $torrents = Torrent::orderBy('registered_at', 'desc');
        $torrents = $this->applySearchQuery($q, $torrents);
        $torrents = $torrents->paginate();

        return view($this->view, compact('torrents', 'q'));
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
                return back()
                    ->withInput()
                    ->with('message', new HtmlString('Данная раздача уже <a class="link" href="' . action("$this->class@torrent", $torrent) . '">присутствует на сайте</a>. Попробуйте добавить другую.'));
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
            'registered_at' => Carbon::createFromTimestamp($data['reg_time']),
        ]);

        return redirect()->action("{$this->class}@torrent", $torrent->id);
    }

    public function categories()
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push('Рубрики');

        $tree = \TorrentCategoryHelper::tree();
        $stats = Torrent::statsByCategories();

        return view($this->view, compact('tree', 'stats'));
    }

    public function category($category_id)
    {
        if (is_null($category = \TorrentCategoryHelper::find($category_id))) {
            abort(404);
        }

        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push($category['title']);

        $ids = \TorrentCategoryHelper::selfAndDescendantsIds($category_id, $category);

        $q = $this->request->input('q');

        $torrents = Torrent::whereIn('category_id', $ids)
            ->orderBy('registered_at', 'desc');
        $torrents = $this->applySearchQuery($q, $torrents);
        $torrents = $torrents->paginate();

        return view('torrents.index', compact('category_id', 'q', 'torrents'));
    }

    public function faq()
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push('Помощь');

        return view($this->view);
    }

    public function magnet(Torrent $torrent)
    {
        $torrent->timestamps = false;
        $torrent->increment('clicks');

        return 'OK';
    }

    public function promo()
    {
        return view($this->view);
    }

    public function torrent(Torrent $torrent)
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push($torrent->title);

        return view($this->view, compact('torrent'));
    }

    protected function applySearchQuery($q, $torrents)
    {
        if (mb_strlen($q) > 2) {
            return $torrents->where('title', 'LIKE', "%{$q}%");
        }

        return $torrents;
    }
}
