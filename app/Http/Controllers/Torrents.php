<?php namespace App\Http\Controllers;

use App\Services\Rto;
use App\Torrent;
use Carbon\Carbon;

class Torrents extends Controller
{
    public function index()
    {
        \Breadcrumbs::push('Торренты');

        $torrents = Torrent::orderBy('registered_at', 'desc')->paginate();

        return view($this->view, compact('torrents'));
    }

    public function add()
    {
        \Breadcrumbs::push('Торренты', 'torrents');
        \Breadcrumbs::push('Добавление');

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
            'user_id' => $this->request->user()->id,
            'category_id' => 0,
            'rto_id' => $data['rto_id'],
            'title' => $data['title'],
            'text' => $data['body'],
            'size' => $data['size'],
            'seeders' => $data['seeders'],
            'info_hash' => $data['info_hash'],
            'announcer' => $data['announcer'],
            'clicks' => 0,
            'registered_at' => Carbon::createFromTimestamp($data['reg_time']),
        ]);

        return redirect()->action("{$this->class}@torrent", $torrent->id);
    }

    public function faq()
    {
        \Breadcrumbs::push('Торренты', 'torrents');
        \Breadcrumbs::push('Помощь');

        return view($this->view);
    }

    public function torrent(Torrent $torrent)
    {
        \Breadcrumbs::push('Торренты', 'torrents');
        \Breadcrumbs::push($torrent->title);

        return view($this->view, compact('torrent'));
    }
}
