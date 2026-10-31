<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsShowForm;
use App\Models\News;
use App\Scope\NewsCurrentLocaleScope;
use App\Scope\NewsPublishedScope;
use Laravel\Head\HeadManager;

class NewsController
{
    public function index(HeadManager $head)
    {
        $news = News::query()
            ->with('user')
            ->withCount('commentsPublished AS comments_count')
            ->tap(new NewsPublishedScope)
            ->tap(new NewsCurrentLocaleScope)
            ->orderByDesc('created_at')
            ->paginate(10);

        $head->feed(url(to('news/rss')), __('Новости'));

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

        \Head::title($news->title);

        return view('news.show', [
            'news' => $news,
        ]);
    }
}
