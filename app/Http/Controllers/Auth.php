<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\PasswordBroker;

class Auth extends Controller
{
    public function login()
    {
        $goto = $this->request->input('goto');

        if ($goto) {
            $this->request->session()->put('url.intended', $goto);
        }

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
            'status'   => User::STATUS_ACTIVE,
        ];

        if (!is_null($result = $this->attemptLogin($credentials))) {
            event(new \App\Events\Stats\UserSignedInWithEmail);

            return $result;
        }

        unset($credentials['email']);

        $credentials['login'] = $this->request->input('email');

        if (!is_null($result = $this->attemptLogin($credentials))) {
            event(new \App\Events\Stats\UserSignedInWithUsername);

            return $result;
        }

        return back()
            ->with('message', 'Электронная почта, логин или пароль неверны')
            ->withInput($this->request->only('email'));
    }

    public function logout()
    {
        \Auth::logout();

        $this->request->session()->flush();
        $this->request->session()->regenerate();

        event(new \App\Events\Stats\UserLoggedOut);

        return redirect(path('Home@index'));
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

        $email = $this->request->input('email');
        $response = $passwords->sendResetLink($this->request->only('email'));

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
        $this->validate($this->request, [
            'mail'     => 'empty',
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $this->request->only('email', 'password', 'token');
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
            ->withInput($this->request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    public function register()
    {
        return view($this->view);
    }

    public function registerPost(PasswordBroker $passwords)
    {
        $this->validate($this->request, [
            'mail'     => 'empty',
            'email'    => 'required|email|max:125',
            'password' => 'required|min:6',
        ]);

        $email = $this->request->input('email');
        $user = User::where('email', $email)->first();

        if (!is_null($user)) {
            $passwords->sendResetLink(compact('email'));

            event(new \App\Events\Stats\UserPasswordRemindedDuringRegistration);

            return back()->with('message', trans('auth.email_taken', ['email' => $email]));
        }

        $data = $this->request->all();

        $user = User::create([
            'email'    => $data['email'],
            'password' => $data['password'],
            'status'   => User::STATUS_ACTIVE,
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
            $this->request->session()->regenerate();

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
