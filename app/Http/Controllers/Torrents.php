<?php namespace App\Http\Controllers;

use App\Services\Rto;
use App\Torrent;
use Carbon\Carbon;

class Torrents extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans($this->view));

        $torrents = Torrent::orderBy('registered_at', 'desc')->paginate();

        return view($this->view, compact('torrents'));
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
            'category_id' => 0,
            'registered_at' => Carbon::createFromTimestamp($data['reg_time']),
        ]);

        return redirect()->action("{$this->class}@torrent", $torrent->id);
    }

    public function faq()
    {
        \Breadcrumbs::push(trans('torrents.index'), 'torrents');
        \Breadcrumbs::push('Помощь');

        return view($this->view);
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
}
