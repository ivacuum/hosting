<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\PasswordBroker;

class Auth extends Controller
{
    public function login()
    {
        $goto = request('goto');

        if ($goto) {
            request()->session()->put('url.intended', $goto);
        }

        return view($this->view);
    }

    public function loginPost()
    {
        request()->validate([
            'mail' => 'empty',

            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => request('email'),
            'password' => request('password'),
            'status' => User::STATUS_ACTIVE,
        ];

        if (!is_null($result = $this->attemptLogin($credentials))) {
            event(new \App\Events\Stats\UserSignedInWithEmail);

            return $result;
        }

        unset($credentials['email']);

        $credentials['login'] = request('email');

        if (!is_null($result = $this->attemptLogin($credentials))) {
            event(new \App\Events\Stats\UserSignedInWithUsername);

            return $result;
        }

        return back()
            ->with('message', 'Электронная почта, логин или пароль неверны')
            ->withInput(request()->only('email'));
    }

    public function logout()
    {
        \Auth::logout();

        request()->session()->flush();
        request()->session()->regenerate();

        event(new \App\Events\Stats\UserLoggedOut);

        return redirect(path('Home@index'));
    }

    public function passwordRemind()
    {
        return view($this->view);
    }

    public function passwordRemindPost(PasswordBroker $passwords)
    {
        request()->validate([
            'mail' => 'empty',
            'email' => 'required|email',
        ]);

        $email = request('email');
        $response = $passwords->sendResetLink(request('email'));

        if (PasswordBroker::RESET_LINK_SENT === $response) {
            event(new \App\Events\Stats\UserPasswordReminded);

            return back()->with('message', trans($response, ['email' => $email]));
        }

        return back()->withErrors(['email' => trans($response)]);
    }

    public function passwordReset($token = '')
    {
        abort_unless($token, 404);

        return view($this->view, compact('token'));
    }

    public function passwordResetPost(PasswordBroker $passwords)
    {
        request()->validate([
            'mail' => 'empty',
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = request()->only('email', 'password', 'token');
        $credentials['password_confirmation'] = $credentials['password'];

        $response = $passwords->reset($credentials, function (User $user, $password) {
            $user->status = User::STATUS_ACTIVE;
            $user->salt = '';
            $user->password = $password;
            $user->remember_token = str_random(60);
            $user->save();

            \Auth::login($user, true);
        });

        if (PasswordBroker::PASSWORD_RESET === $response) {
            event(new \App\Events\Stats\UserPasswordResetted);

            return redirect(path('Home@index'))->with('message', trans($response));
        }

        return back()
            ->withInput(request()->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    public function register()
    {
        return view($this->view);
    }

    public function registerPost(PasswordBroker $passwords)
    {
        $data = request()->validate([
            'mail' => 'empty',
            'email' => 'required|email|max:125',
            'password' => 'required|min:6',
        ]);

        $email = request('email');
        $user = User::where('email', $email)->first();

        if (!is_null($user)) {
            $passwords->sendResetLink(compact('email'));

            event(new \App\Events\Stats\UserPasswordRemindedDuringRegistration);

            return back()->with('message', trans('auth.email_taken', ['email' => $email]));
        }

        $user = User::create([
            'email' => $data['email'],
            'status' => User::STATUS_ACTIVE,
            'password' => $data['password'],
        ]);

        event(new \App\Events\Stats\UserRegisteredWithEmail);

        // Mail::send('emails.users.activation', compact('user'), function ($mail) use ($user) {
        // 	$mail->to($user->email)->subject("Активация учетной записи");
        // });

        \Auth::login($user, true);

        return redirect(path('Home@index'));
    }

    /**
     * Попытка входа по предоставленным данным
     *
     * @param array   $credentials
     *
     * @return \Illuminate\Http\RedirectResponse|null
     */
    protected function attemptLogin(array $credentials)
    {
        $remember = true;

        if (\Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();

            return redirect()->intended(path('Home@index'));
        }

        if (is_null($user = \Auth::getLastAttempted())) {
            return null;
        }

        if ($user->isPasswordOld() && $user->isOldPasswordCorrect($credentials['password'])) {
            $user->salt = '';
            $user->password = $credentials['password'];
            $user->save();

            \Auth::login($user, $remember);

            return redirect()->intended(path('Home@index'));
        }

        return null;
    }
}
