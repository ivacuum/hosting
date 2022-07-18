<?php namespace App\Http\Controllers;

use App\Http\Requests\NewsShowForm;
use App\News;
use App\Scope\NewsCurrentLocaleScope;
use App\Scope\NewsPublishedScope;
use Illuminate\Database\Eloquent\Builder;

class NewsController
{
    public function index($year = null, $month = null, $day = null)
    {
        $news = News::with('user')
            ->withCount('commentsPublished AS comments_count')
            ->tap(new NewsPublishedScope)
            ->tap(new NewsCurrentLocaleScope)
            ->when($year || $month || $day, fn (Builder $query) => $query->whereBetween('created_at', News::interval($year, $month, $day)))
            ->orderByDesc('created_at')
            ->paginate();

        return view('news.index', ['news' => $news]);
    }

    public function show(NewsShowForm $request)
    {
        if ($request->shouldRedirectToIndex()) {
            return redirect(path([self::class, 'index']), 301);
        }

        $request->ensureNewsIsPublished();

        $news = $request->news;

        if ($url = $request->redirectUrlToOriginLocale()) {
            return redirect($url, 301);
        }

        event(new \App\Events\Stats\NewsViewed($news->id));

        \Breadcrumbs::push($news->breadcrumb());

        return view('news.show', [
            'news' => $news,
            'metaTitle' => $news->title,
            'noLanguageSelector' => true,
        ]);
    }
}
