<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Domain\UserStatus;
use App\Events\Stats\UserLoggedOut;
use App\Events\Stats\UserSignedInWithEmail;
use App\Events\Stats\UserSignedInWithUsername;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Requests\Auth\SignInForm;
use App\Http\Requests\Auth\SignInIndexForm;

class SignIn extends Controller
{
    public function index(SignInIndexForm $request)
    {
        if ($request->goto) {
            \Redirect::setIntendedUrl($request->goto);
        }

        return view('auth.login');
    }

    public function login(SignInForm $request)
    {
        if ($this->attemptLogin($request)) {
            $this->loginOkCallback();

            return $this->sendOkResponse($request);
        }

        if ($this->attemptLogin($request, 'login')) {
            $this->loginCustomOkCallback();

            return $this->sendOkResponse($request);
        }

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

    protected function attemptLogin(SignInForm $request, string $username = 'email'): bool
    {
        $credentials = $this->credentials($request, $username);

        try {
            if (\Auth::attempt($credentials, $request->remember)) {
                return true;
            }
        } catch (\RuntimeException) {
            // Laravel 13 `Auth::attempt()` стал бросать RuntimeException: This password does not use the Bcrypt algorithm.
            // Заглушаем его, чтобы попробовать конвертировать старый md5-пароль
        }

        if (null === $user = \Auth::getLastAttempted()) {
            return false;
        }

        if ($user->isPasswordOld() && $user->isOldPasswordCorrect($credentials['password'])) {
            $user->salt = '';
            $user->password = $credentials['password'];
            $user->save();

            \Auth::login($user, $request->remember);

            return true;
        }

        return false;
    }

    protected function credentials(SignInForm $request, string $username): array
    {
        return [
            'status' => UserStatus::Active,
            'password' => $request->password,
            $username => $request->emailOrLogin,
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

    protected function sendFailedResponse(SignInForm $request)
    {
        return back()
            ->with(SessionKey::FlashMessage->value, __('auth.failed'))
            ->withInput([
                'email' => $request->emailOrLogin,
                'foreign' => $request->remember ? null : 'on',
            ]);
    }

    protected function sendLoggedOutResponse()
    {
        return redirect(path(HomeController::class));
    }

    protected function sendOkResponse(SignInForm $request)
    {
        $request->session()->regenerate();

        return $this->sendAuthenticatedResponse();
    }
}
