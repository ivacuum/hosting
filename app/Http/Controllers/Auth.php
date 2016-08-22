<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;

class Auth extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        parent::__construct();

        $this->auth = $auth;

        $this->middleware('auth', ['only' => 'logout']);
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        return view($this->view);
    }

    public function loginPost()
    {
        $this->validate($this->request, [
            'mail'     => 'empty',
            'email'    => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email'    => $this->request->input('email'),
            'password' => $this->request->input('password'),
            'active'   => 1,
        ];

        if ($this->auth->attempt($credentials, !$this->request->has('foreign'))) {
            return redirect()->intended('/');
        }

        return redirect('/auth/login')
            ->withMessage('Электронная почта или пароль неверны')
            ->withInput();
    }

    public function logout()
    {
        $this->auth->logout();

        return redirect('/');
    }

    public function passwordRemind()
    {
        return view($this->view);
    }

    public function passwordRemindPost(PasswordBroker $passwords)
    {
        $this->validate($this->request, [
            'mail'  => 'empty',
            'email' => 'required|email',
        ]);

        $response = $passwords->sendResetLink($this->request->only('email'), function ($mail) {
            $mail->subject('Восстановление пароля');
        });

        switch ($response)
        {
            case PasswordBroker::RESET_LINK_SENT:
                return redirect()->back()->with('message', trans($response));

            case PasswordBroker::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function passwordReset($token = '')
    {
        if (!$token) {
            abort(404);
        }

        return view($this->view, compact('token'));
    }

    public function passwordResetPost(PasswordBroker $passwords)
    {
        $this->validate($this->request, [
            'mail'     => 'empty',
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $this->request->only('email', 'password', 'token');
        $credentials['password_confirmation'] = $credentials['password'];

        $response = $passwords->reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
            $this->auth->login($user);
        });

        switch ($response) {
            case PasswordBroker::PASSWORD_RESET:
                return redirect('/');

            default:
                return redirect()->back()
                            ->withInput($this->request->only('email'))
                            ->withErrors(['email' => trans($response)]);
        }
    }

    public function register()
    {
        return view($this->view);
    }

    public function registerPost()
    {
        $this->validate($this->request, [
            'mail'     => 'empty',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $data = $this->request->all();

        $user = User::create([
            'email'    => $data['email'],
            'password' => $data['password'],
            'active'   => 1,
        ]);

        // Mail::send('emails.users.activation', compact('user'), function ($mail) use ($user) {
        // 	$mail->to($user->email)->subject("Активация учетной записи");
        // });

        $this->auth->login($user);

        return redirect('/');
    }
}
