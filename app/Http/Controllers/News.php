<?php namespace App\Http\Controllers;

use App\News as Model;

class News extends Controller
{
    public function index($year = null, $month = null, $day = null)
    {
        \Breadcrumbs::push(trans('news.index'), "news");

        $validator = \Validator::make(compact('year', 'month', 'day'), [
            'day' => 'date_format:d|nullable',
            'year' => 'date_format:Y|nullable',
            'month' => 'date_format:m|nullable',
        ]);

        if ($validator->fails()) {
            abort(404);
        }

        $news = Model::orderBy('id', 'desc');

        switch (\App::getLocale()) {
            case 'en': $news = $news->where('site_id', 12); break;
            default: $news = $news->where('site_id', 11); break;
        }

        if ($year || $month || $day) {
            $news = $news->whereBetween('created_at', Model::interval($year, $month, $day));

            \Breadcrumbs::push($year, "news/{$year}");

            if ($month) {
                \Breadcrumbs::push($month, "news/{$year}/{$month}");
            }

            if ($day) {
                \Breadcrumbs::push($day);
            }
        }

        $news = $news->paginate();

        return view('news.index', compact('news'));
    }

    public function day($year, $month, $day)
    {
        return $this->index($year, $month, $day);
    }

    public function month($year, $month)
    {
        return $this->index($year, $month);
    }

    public function show($year, $month, $day, $slug)
    {
        // Обратная совместимость
        if (ends_with($slug, '.html')) {
            $slug = mb_substr($slug, 0, -5);

            return redirect(action("{$this->class}@show", [$year, $month, $day, $slug]), 301);
        }

        $news = Model::where('slug', $slug)
            ->whereBetween('created_at', Model::interval($year, $month, $day))
            ->first();

        if (is_null($news)) {
            abort(404);
        }

        $news->incrementViews();

        \Breadcrumbs::push(trans('news.index'), "news");
        \Breadcrumbs::push($year, "news/{$year}");
        \Breadcrumbs::push($month, "news/{$year}/{$month}");
        \Breadcrumbs::push($day, "news/{$year}/{$month}/{$day}");
        \Breadcrumbs::push($news->title);

        $meta_title = $news->title;

        return view($this->view, compact('meta_title', 'news'));
    }

    public function year($year)
    {
        return $this->index($year);
    }
}
