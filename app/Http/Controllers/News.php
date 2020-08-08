<?php namespace App\Http\Controllers;

use App\Http\Requests\NewsShowRequest;
use App\News as Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Controller
{
    public function index($year = null, $month = null, $day = null)
    {
        $news = Model::with('user')
            ->withCount('commentsPublished AS comments_count')
            ->published()
            ->where('locale', \App::getLocale())
            ->when($year || $month || $day, fn (Builder $query) => $query->whereBetween('created_at', Model::interval($year, $month, $day)))
            ->orderByDesc('created_at')
            ->paginate();

        return view('news.index', ['news' => $news]);
    }

    public function show(NewsShowRequest $request)
    {
        if ($request->shouldRedirectToIndex()) {
            return redirect(path([self::class, 'index']), 301);
        }

        $news = $request->news();

        abort_unless($news->isPublished(), 404);

        if ($url = $request->redirectUrlToOriginLocale()) {
            return redirect($url, 301);
        }

        event(new \App\Events\Stats\NewsViewed($news->id));

        \Breadcrumbs::push($news->breadcrumb());

        return view('news.show', [
            'news' => $news,
            'comments' => $news->commentsPublished()->with('user')->orderBy('created_at')->get(),
            'metaTitle' => $news->title,
        ]);
    }
}
