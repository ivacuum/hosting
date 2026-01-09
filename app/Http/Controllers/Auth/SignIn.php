<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Events\Stats\UserLoggedOut;
use App\Events\Stats\UserSignedInWithEmail;
use App\Events\Stats\UserSignedInWithUsername;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class SignIn extends Controller
{
    use ValidatesRequests;

    protected $username = 'email';
    protected $remember = true;

    public function index()
    {
        if ($goto = request('goto')) {
            \Redirect::setIntendedUrl($goto);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $this->loginOkCallback();

            return $this->sendOkResponse($request);
        }

        $username = $this->username();

        if ($this->attemptLoginCustom($request)) {
            $this->loginCustomOkCallback();

            return $this->sendOkResponse($request);
        }

        $this->username = $username;

        return $this->sendFailedResponse($request);
    }

    public function logout()
    {
        \Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        event(new UserLoggedOut);

        return $this->sendLoggedOutResponse();
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        if (\Auth::attempt($credentials, $this->remember)) {
            return true;
        }

        if (null === $user = \Auth::getLastAttempted()) {
            return false;
        }

        if ($user->isPasswordOld() && $user->isOldPasswordCorrect($credentials['password'])) {
            $user->salt = '';
            $user->password = $credentials['password'];
            $user->save();

            \Auth::login($user, $this->remember);

            return true;
        }

        return false;
    }

    protected function attemptLoginCustom(Request $request)
    {
        $this->username = 'login';

        return $this->attemptLogin($request);
    }

    protected function credentials(Request $request)
    {
        return [
            'status' => User::STATUS_ACTIVE,
            'password' => $request->input('password'),
            $this->username() => $request->input('email'),
        ];
    }

    protected function loginOkCallback()
    {
        event(new UserSignedInWithEmail);
    }

    protected function loginCustomOkCallback()
    {
        event(new UserSignedInWithUsername);
    }

    protected function sendAuthenticatedResponse()
    {
        return redirect()->intended(path(HomeController::class));
    }

    protected function sendFailedResponse(Request $request)
    {
        return back()
            ->with(SessionKey::FlashMessage->value, __('auth.failed'))
            ->withInput($request->except('password'));
    }

    protected function sendLoggedOutResponse()
    {
        return redirect(path(HomeController::class));
    }

    protected function sendOkResponse(Request $request)
    {
        $request->session()->regenerate();

        return $this->sendAuthenticatedResponse();
    }

    protected function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
