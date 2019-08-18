<?php namespace App\Http\Controllers\Acp;

use App\User as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Users extends Controller
{
    protected $sortable_keys = ['id', 'last_login_at', 'comments_count', 'images_count', 'torrents_count', 'trips_count'];
    protected $show_with_count = ['chatMessages', 'comments', 'externalIdentities', 'images', 'torrents', 'trips'];

    public function index()
    {
        $q = request('q');
        $avatar = request('avatar');
        $last_login_at = request('last_login_at');

        [$sortKey, $sortDir] = $this->getSortParams();

        $models = Model::withCount(['comments', 'images', 'torrents', 'trips'])
            ->when(null !== $avatar, function (Builder $query) use ($avatar) {
                return $query->where('avatar', $avatar ? '<>' : '=', '');
            })
            ->when($last_login_at === 'week', function (Builder $query) {
                return $query->where('last_login_at', '>', now()->subWeek()->toDateTimeString());
            })
            ->when($last_login_at === 'month', function (Builder $query) {
                return $query->where('last_login_at', '>', now()->subMonth()->toDateTimeString());
            })
            ->when($q, function (Builder $query) use ($q) {
                if (is_numeric($q)) {
                    return $query->where('id', $q);
                }

                return $query->where('email', 'LIKE', "%{$q}%");
            })
            ->orderBy($sortKey, $sortDir)
            ->paginate()
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('avatar', 'models'));
    }

    protected function mailCredentials(Model $model, $password)
    {
        $route = path('Acp\Home@index', [], true);
        $vars  = compact('user', 'password', 'route');

        \Mail::send('emails.users.credentials', $vars, function ($mail) use ($model, $route) {
            $mail->to($model->email)->subject("Доступ к {$route}");
        });

        session()->flash('message', "Данные высланы на почту {$model->email}");
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($model->id ?? null),
            ],
            'status' => 'boolean',
            'password' => null === $model ? 'required_without:random_password|min:8' : 'min:8',
        ];
    }

    protected function storeModel()
    {
        $random_password = request('random_password');
        $password = $random_password ? Str::random(16) : request('password');

        $model = new Model;
        $model->email = request('email');
        $model->status = request('status', 0);
        $model->password = $password;
        $model->save();

        if (request('mail_credentials')) {
            $this->mailCredentials($model, $password);
        }

        return $model;
    }

    /**
     * @param Model $model
     */
    protected function updateModel($model)
    {
        $randomPassword = request('random_password');
        $password = $randomPassword ? Str::random(16) : request('password');
        $mailCredentials = request('mail_credentials');

        $model->email = request('email');
        $model->status = request('status', Model::STATUS_INACTIVE);

        if ($password) {
            $model->password = $password;
        }

        $model->save();

        if ($password && $mailCredentials) {
            $this->mailCredentials($model, $password);
        }
    }
}
