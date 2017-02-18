<?php namespace App\Http\Controllers;

use App\Events\Stats\NewsViewed;
use App\News as Model;

class News extends Controller
{
    public function index($year = null, $month = null, $day = null)
    {
        \Breadcrumbs::push(trans('news.index'), 'news');

        $news = Model::with('user')
            ->withCount('comments')
            ->published()
            ->orderBy('created_at', 'desc');

        switch (\App::getLocale()) {
            case 'en': $news = $news->where('site_id', 12); break;
            default: $news = $news->where('site_id', 11); break;
        }

        if ($year || $month || $day) {
            $news = $news->whereBetween('created_at', Model::interval($year, $month, $day));
        }

        $news = $news->paginate();

        return view('news.index', compact('news'));
    }

    public function bc()
    {
        return redirect()->action("{$this->class}@index", [], 301);
    }

    public function day($year, $month, $day)
    {
        $validator = \Validator::make(
            ['date' => "{$year}-{$month}-{$day}"],
            ['date' => 'date_format:Y-m-d']
        );

        abort_unless($validator->passes(), 404);

        return $this->index($year, $month, $day);
    }

    public function month($year, $month)
    {
        $validator = \Validator::make(
            ['date' => "{$year}-{$month}"],
            ['date' => 'date_format:Y-m']
        );

        abort_unless($validator->passes(), 404);

        return $this->index($year, $month);
    }

    public function show($id)
    {
        $news = Model::find($id);

        if (is_null($news)) {
            return redirect()->action("{$this->class}@index");
        }

        abort_unless($news->status === Model::STATUS_PUBLISHED, 404);

        $comments = $news->comments()->with('user')->orderBy('id', 'desc')->paginate();

        event(new NewsViewed($news->id));

        \Breadcrumbs::push(trans('news.index'), 'news');
        \Breadcrumbs::push($news->title);

        $meta_title = $news->title;

        return view($this->view, compact('comments', 'meta_title', 'news'));
    }

    public function year($year)
    {
        $validator = \Validator::make(
            compact('year'),
            ['year' => 'date_format:Y']
        );

        abort_unless($validator->passes(), 404);

        return $this->index($year);
    }
}
