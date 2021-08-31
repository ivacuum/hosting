<?php namespace App\Http\Controllers\Acp;

use App\User as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class Users extends AbstractController
{
    protected $sortableKeys = ['id', 'last_login_at', 'comments_count', 'images_count', 'torrents_count', 'trips_count'];
    protected $showWithCount = ['chatMessages', 'comments', 'externalIdentities', 'images', 'torrents', 'trips'];

    public function index()
    {
        $q = request('q');
        $avatar = request('avatar');
        $lastLoginAt = request('last_login_at');

        $models = Model::query()
            ->withCount(['comments', 'images', 'torrents', 'trips'])
            ->when(null !== $avatar, fn (Builder $query) => $query->where('avatar', $avatar ? '<>' : '=', ''))
            ->when($lastLoginAt === 'week', fn (Builder $query) => $query->where('last_login_at', '>', now()->subWeek()->toDateTimeString()))
            ->when($lastLoginAt === 'month', fn (Builder $query) => $query->where('last_login_at', '>', now()->subMonth()->toDateTimeString()))
            ->when($q, function (Builder $query) use ($q) {
                if (is_numeric($q)) {
                    return $query->where('id', $q);
                }

                return $query->where('email', 'LIKE', "%{$q}%");
            })
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate();

        return view($this->view, [
            'avatar' => $avatar,
            'models' => $models,
        ]);
    }

    protected function mailCredentials(Model $model, $password)
    {
        $vars = [
            'user' => $model,
            'route' => path([Home::class, 'index'], [], true),
            'password' => $password,
        ];

        \Mail::send('emails.users.credentials', $vars, function ($mail) use ($model, $vars) {
            $mail->to($model)->subject("Доступ к {$vars['route']}");
        });

        session()->flash('message', "Данные высланы на почту {$model->email}");
    }

    /**
     * @param Model|null $model
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
            'password' => Rule::when($model === null, 'required_without:random_password|min:8', 'min:8'),
        ];
    }

    protected function storeModel()
    {
        $randomPassword = request('random_password');
        $password = $randomPassword ? \Str::random(16) : request('password');

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
        $password = $randomPassword ? \Str::random(16) : request('password');
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
