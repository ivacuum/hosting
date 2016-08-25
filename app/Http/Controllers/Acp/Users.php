<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\UserCreate as ModelCreate;
use App\Http\Requests\Acp\UserEdit as ModelEdit;
use App\User as Model;
use Breadcrumbs;
use Mail;
use Session;

class Users extends Controller
{
    const URL_PREFIX = 'acp/users';

    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::push(trans("{$this->prefix}.index"), self::URL_PREFIX);
    }

    public function index()
    {
        $models = Model::get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        Breadcrumbs::push(trans($this->view));

        return view($this->view);
    }

    public function destroy(Model $model)
    {
        $model->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function edit(Model $model)
    {
        Breadcrumbs::push($model->email, self::URL_PREFIX . "/{$model->id}");
        Breadcrumbs::push(trans($this->view));

        return view($this->view, compact('model'));
    }

    public function show(Model $model)
    {
        Breadcrumbs::push($model->email);

        return view($this->view, compact('model'));
    }

    public function store(ModelCreate $request)
    {
        $random_password = $request->input('random_password');
        $password = $random_password ? str_random(16) : $request->input('password');

        $model = new Model;
        $model->email    = $request->input('email');
        $model->password = $password;
        $model->active   = $request->input('active', 0);
        $model->is_admin = $request->input('is_admin', 0);
        $model->save();

        if ($request->input('mail_credentials')) {
            $this->mailCredentials($model, $password);
        }

        return redirect()->action("{$this->class}@index");
    }

    public function update(Model $model, ModelEdit $request)
    {
        $random_password = $request->input('random_password');
        $password = $random_password ? str_random(16) : $request->input('password');
        $mail_credentials = $request->input('mail_credentials');

        $model->email    = $request->input('email');
        $model->active   = $request->input('active', 0);
        $model->is_admin = $request->input('is_admin', 0);

        if ($password) {
            $model->password = $password;
        }

        $model->save();

        if ($password && $mail_credentials) {
            $this->mailCredentials($model, $password);
        }

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$model, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $model);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
    }

	protected function mailCredentials(Model $model, $password)
	{
		$route = action('Acp\Home@index');
		$vars  = compact('user', 'password', 'route');

		Mail::send('emails.users.credentials', $vars, function ($mail) use ($model, $route) {
			$mail->to($model->email)->subject("Доступ к {$route}");
		});

		Session::flash('message', "Данные высланы на почту {$model->email}");
	}
}
