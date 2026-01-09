<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Events\Stats\UserPasswordResetted;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;

class ResetPassword extends Controller
{
    /**
     * Флаг будет установлен в true, если пользователю запрещено
     * восстанавливать пароль (см. userStatusesOkToReset())
     *
     * @var bool
     */
    protected $bannedUser = false;

    public function index($token = null)
    {
        abort_unless($token, 404);

        return view('auth.password_reset', ['token' => $token]);
    }

    public function reset(PasswordBroker $broker)
    {
        $credentials = request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials['password_confirmation'] = $credentials['password'];

        $response = $broker->reset($credentials, function (User $user, string $password) {
            if (in_array($user->status, $this->userStatusesOkToReset())) {
                $this->resetOkCallback($user, $password);
            } else {
                $this->bannedUser = true;
            }
        });

        if ($this->bannedUser) {
            return $this->sendBannedResponse();
        }

        return $response === PasswordBroker::PASSWORD_RESET
            ? $this->sendOkResponse($response)
            : $this->sendFailedResponse($response);
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

    protected function sendBannedResponse()
    {
        return back()
            ->withInput(request(['email']))
            ->with(SessionKey::FlashMessage->value, __('passwords.banned'));
    }

    protected function sendFailedResponse(string $response)
    {
        return back()
            ->withInput(request(['email']))
            ->withErrors(['email' => __($response)]);
    }

    protected function sendOkResponse(string $response)
    {
        event(new UserPasswordResetted);

        return redirect($this->redirectPath())
            ->with(SessionKey::FlashMessage->value, __($response));
    }

    protected function userStatusesOkToReset()
    {
        return [
            User::STATUS_INACTIVE,
            User::STATUS_ACTIVE,
        ];
    }
}
