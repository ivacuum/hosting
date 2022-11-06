<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Users extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        [$sortKey, $sortDir] = $applyIndexGoods->execute(
            new User,
            ['id', 'last_login_at', 'comments_count', 'images_count', 'issues_count', 'magnets_count', 'trips_count'],
        );

        $q = request('q');
        $avatar = request('avatar');
        $lastLoginAt = request('last_login_at');

        $models = User::query()
            ->withCount(['comments', 'images', 'issues', 'magnets', 'trips'])
            ->when(null !== $avatar, fn (Builder $query) => $query->where('avatar', $avatar ? '<>' : '=', ''))
            ->when($lastLoginAt === 'week', fn (Builder $query) => $query->where('last_login_at', '>', now()->subWeek()->toDateTimeString()))
            ->when($lastLoginAt === 'month', fn (Builder $query) => $query->where('last_login_at', '>', now()->subMonth()->toDateTimeString()))
            ->when($q, function (Builder $query) use ($q) {
                if (is_numeric($q)) {
                    return $query->where('id', $q);
                }

                return $query->where('email', 'LIKE', "%{$q}%");
            })
            ->orderBy($sortKey, $sortDir)
            ->paginate();

        return view('acp.users.index', [
            'avatar' => $avatar,
            'models' => $models,
        ]);
    }

    public function create(User $user, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($user);
    }

    public function destroy(User $user, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($user);
    }

    public function edit(User $user, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($user);
    }

    public function show(User $user, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($user, [
            'chatMessages',
            'comments',
            'externalIdentities',
            'images',
            'issues',
            'magnets',
            'trips',
        ]);
    }
}
