<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\UserCreate as ModelCreate;
use App\Http\Requests\Acp\UserEdit as ModelEdit;
use App\User as Model;
use Mail;

class Users extends Controller
{
    protected $title_attr = 'email';

    public function index()
    {
        $models = Model::orderBy('id', 'desc')->paginate();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        return view('acp.create');
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
        return view('acp.edit', compact('model'));
    }

    public function show(Model $model)
    {
        return view($this->view, compact('model'));
    }

    public function store(ModelCreate $request)
    {
        $random_password = $request->input('random_password');
        $password = $random_password ? str_random(16) : $request->input('password');

        $model = new Model;
        $model->email    = $request->input('email');
        $model->password = $password;
        $model->status   = $request->input('status', 0);
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
        $model->status   = $request->input('status', 0);

        if ($password) {
            $model->password = $password;
        }

        $model->save();

        if ($password && $mail_credentials) {
            $this->mailCredentials($model, $password);
        }

        return $this->redirectAfterUpdate($model);
    }

    protected function mailCredentials(Model $model, $password)
    {
        $route = action('Acp\Home@index');
        $vars  = compact('user', 'password', 'route');

        Mail::send('emails.users.credentials', $vars, function ($mail) use ($model, $route) {
            $mail->to($model->email)->subject("Доступ к {$route}");
        });

        $this->request->session()->flash('message', "Данные высланы на почту {$model->email}");
    }
}
