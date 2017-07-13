<?php namespace App\Http\Controllers\Acp;

use App\User as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Mail;

class Users extends Controller
{
    protected $sortable_keys = ['id', 'last_login_at', 'comments_count', 'images_count', 'torrents_count'];
    protected $show_with_count = ['comments', 'images', 'torrents'];

    public function index()
    {
        $filter = $this->request->input('filter');

        list($sort_key, $sort_dir) = $this->getSortParams();

        $models = Model::withCount('comments', 'images', 'torrents')
            ->applyFilter($filter)
            ->orderBy($sort_key, $sort_dir)
            ->paginate();

        return view($this->view, compact('filter', 'models'));
    }

    protected function mailCredentials(Model $model, $password)
    {
        $route = path('Acp\Home@index', [], true);
        $vars  = compact('user', 'password', 'route');

        Mail::send('emails.users.credentials', $vars, function ($mail) use ($model, $route) {
            $mail->to($model->email)->subject("Доступ к {$route}");
        });

        $this->request->session()->flash('message', "Данные высланы на почту {$model->email}");
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
            'password' => is_null($model) ? 'required_without:random_password|min:6' : 'min:6',
        ];
    }

    protected function storeModel()
    {
        $random_password = $this->request->input('random_password');
        $password = $random_password ? str_random(16) : $this->request->input('password');

        $model = new Model;
        $model->email = $this->request->input('email');
        $model->status = $this->request->input('status', 0);
        $model->password = $password;
        $model->save();

        if ($this->request->input('mail_credentials')) {
            $this->mailCredentials($model, $password);
        }

        return $model;
    }

    /**
     * @param Model $model
     */
    protected function updateModel($model)
    {
        $random_password = $this->request->input('random_password');
        $password = $random_password ? str_random(16) : $this->request->input('password');
        $mail_credentials = $this->request->input('mail_credentials');

        $model->email = $this->request->input('email');
        $model->status = $this->request->input('status', Model::STATUS_INACTIVE);

        if ($password) {
            $model->password = $password;
        }

        $model->save();

        if ($password && $mail_credentials) {
            $this->mailCredentials($model, $password);
        }
    }
}
