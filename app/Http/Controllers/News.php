<?php namespace App\Http\Controllers;

use App\News as Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Controller
{
    public function index($year = null, $month = null, $day = null)
    {
        $locale = \App::getLocale();

        $news = Model::with('user')
            ->withCount('commentsPublished as comments_count')
            ->published()
            ->when($locale === 'en', function (Builder $query) {
                return $query->where('site_id', 12);
            })
            ->when($locale === 'ru', function (Builder $query) {
                return $query->where('site_id', 11);
            })
            ->when($year || $month || $day, function (Builder $query) use ($year, $month, $day) {
                return $query->whereBetween('created_at', Model::interval($year, $month, $day));
            })
            ->orderBy('created_at', 'desc')
            ->paginate();

        \Breadcrumbs::push(trans('news.index'), 'news');

        return view('news.index', compact('news'));
    }

    public function bc()
    {
        return redirect(path("{$this->class}@index"), 301);
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
            return redirect(path("{$this->class}@index"), 301);
        }

        abort_unless($news->status === Model::STATUS_PUBLISHED, 404);

        if ($url = $this->redirectUrlToOriginLocale($news)) {
            return redirect($url, 301);
        }

        $comments = $news->commentsPublished()->with('user')->orderBy('id')->get();

        event(new \App\Events\Stats\NewsViewed($news->id));

        \Breadcrumbs::push(trans('news.index'), 'news')
            ->push($news->title);

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

    protected function redirectUrlToOriginLocale(Model $news)
    {
        $locale = \App::getLocale();

        if ($locale === 'en' && $news->site_id === 11) {
            return request()->path();
        } elseif ($locale === 'ru' && $news->site_id === 12) {
            return '/en/'.request()->path();
        }

        return '';
    }
}
