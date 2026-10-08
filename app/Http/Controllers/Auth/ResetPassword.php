<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Events\Stats\UserPasswordResetted;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Requests\Auth\ResetPasswordForm;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;

class ResetPassword extends Controller
{
    public function index($token = null)
    {
        abort_unless($token, 404);

        return view('auth.password_reset', ['token' => $token]);
    }

    public function reset(ResetPasswordForm $request, PasswordBroker $broker)
    {
        $credentials = [
            'token' => $request->token,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password,
        ];

        $response = $broker->reset($credentials, $this->resetOkCallback(...));

        return $response === PasswordBroker::PASSWORD_RESET
            ? $this->sendOkResponse($response)
            : $this->sendFailedResponse($request, $response);
    }

    protected function redirectPath(): string
    {
        return path(HomeController::class);
    }

    protected function resetOkCallback(User $user, string $password): void
    {
        $user->activate();

        $user->password = $password;

        $user->setRememberToken(\Str::random(60));
        $user->save();

        event(new PasswordReset($user));

        \Auth::login($user);
    }

    protected function sendFailedResponse(ResetPasswordForm $request, string $response)
    {
        return back()
            ->withInput(['email' => $request->email])
            ->withErrors(['email' => __($response)]);
    }

    protected function sendOkResponse(string $response)
    {
        event(new UserPasswordResetted);

        return redirect($this->redirectPath())
            ->with(SessionKey::FlashMessage->value, __($response));
    }
}
