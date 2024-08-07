<?php

namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Domain\NotificationDeliveryMethod;
use App\Domain\UserStatus;
use App\News;
use App\Notifications\NewsPublishedNotification;
use App\Scope\NewsCurrentLocaleScope;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(News::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new News);

        $userId = request('user_id');

        $models = News::query()
            ->withCount('comments')
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->tap(new NewsCurrentLocaleScope)
            ->orderBy(match ($sort->key) {
                'views',
                'comments_count' => $sort->key,
                default => 'id',
            }, $sort->direction->value)
            ->paginate(20);

        return view('acp.news.index', [
            'models' => $models,
            'user_id' => $userId,
        ]);
    }

    public function create(News $news, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($news);
    }

    public function destroy(News $news, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($news);
    }

    public function edit(News $news, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($news);
    }

    public function notify(News $news)
    {
        if (!$news->status->isPublished()) {
            return back()->with('message', 'Для рассылки уведомлений новость должна быть опубликована');
        }

        $users = User::query()
            ->where('notify_news', NotificationDeliveryMethod::Mail)
            ->where('status', UserStatus::Active)
            ->where('locale', $news->locale)
            ->get();

        \Notification::send($users, new NewsPublishedNotification($news));

        return back()->with('message', "Уведомления разосланы пользователям: {$users->count()}");
    }

    public function show(News $news, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($news, ['comments']);
    }
}
