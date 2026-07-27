<?php

namespace App\Http\Controllers\Auth;

use App\Domain\SessionKey;
use App\Domain\UserStatus;
use App\Events\Stats\UserPasswordRemindedDuringRegistration;
use App\Events\Stats\UserRegisteredWithEmail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Requests\Auth\NewAccountForm;
use App\User;
use Illuminate\Auth\Events\Registered;

class NewAccount extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(NewAccountForm $request)
    {
        $user = User::query()->where('email', $request->email)->first();

        if ($user !== null) {
            return $this->existingUserResponse($user);
        }

        $user = $this->createUser($request);

        event(new Registered($user));

        return $this->registeredResponse($user);
    }

    protected function createUser(NewAccountForm $request): User
    {
        event(new UserRegisteredWithEmail);

        $user = new User;
        $user->email = $request->email;
        $user->status = UserStatus::Inactive;
        $user->password = $request->password;
        $user->activation_token = \Str::random(16);
        $user->save();

        return $user;
    }

    protected function existingUserResponse(User $user)
    {
        \Password::broker()->sendResetLink(['email' => $user->email]);

        event(new UserPasswordRemindedDuringRegistration);

        return back()
            ->with(SessionKey::FlashMessage->value, __('auth.email_taken', ['email' => $user->email]));
    }

    protected function registeredResponse(User $user)
    {
        $user->activate();

        \Auth::login($user, true);

        return redirect(path(HomeController::class));
    }
}
