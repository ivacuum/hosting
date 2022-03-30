<?php namespace App\Action;

use App\Domain\UserStatus;
use App\Exceptions\EmailHostUnavailableForAutoRegistration;
use App\User;

class FindUserByEmailOrCreateAction
{
    public function execute(string $email, UserStatus $status = UserStatus::Inactive)
    {
        if ($user = User::firstWhere('email', $email)) {
            return $user;
        }

        if (str($email)->contains(config('cfg.autoregister_suffixes_blacklist'))) {
            throw new EmailHostUnavailableForAutoRegistration;
        }

        $user = new User;
        $user->email = $email;
        $user->status = $status->value;
        $user->save();

        event(new \App\Events\Stats\UserRegisteredAuto);

        return $user;
    }
}
