<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\PasswordBroker;

class Auth extends Controller
{
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

        if (\Auth::attempt($credentials, !$this->request->has('foreign'))) {
            $this->request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()
            ->with('message', 'Электронная почта или пароль неверны')
            ->withInput($this->request->only('email', 'foreign'));
    }

    public function logout()
    {
        \Auth::logout();

        $this->request->session()->flush();
        $this->request->session()->regenerate();

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

        $response = $passwords->sendResetLink($this->request->only('email'));

        if (PasswordBroker::RESET_LINK_SENT === $response) {
            return back()->with('message', trans($response));
        }

        return back()->withErrors(['email' => trans($response)]);
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
            'password' => 'required|min:6',
        ]);

        $credentials = $this->request->only('email', 'password', 'token');
        $credentials['password_confirmation'] = $credentials['password'];

        $response = $passwords->reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->remember_token = str_random(60);
            $user->save();
            \Auth::login($user);
        });

        if (PasswordBroker::PASSWORD_RESET === $response) {
            return redirect('/')->with('message', trans($response));
        }

        return back()
            ->withInput($this->request->only('email'))
            ->withErrors(['email' => trans($response)]);
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

        \Auth::login($user);

        return redirect('/');
    }
}
