<?php

namespace App\Action;

use App\Domain\Config;
use App\Domain\UserStatus;
use App\Events\Stats\UserFoundByEmailWhenCommentAdded;
use App\Events\Stats\UserFoundByEmailWhenIssueAdded;
use App\Events\Stats\UserFoundByEmailWhenSubscribing;
use App\Events\Stats\UserRegisteredAutoWhenCommentAdded;
use App\Events\Stats\UserRegisteredAutoWhenIssueAdded;
use App\Events\Stats\UserRegisteredAutoWhenSubscribing;
use App\Exceptions\EmailHostUnavailableForAutoRegistration;
use App\User;

class FindUserByEmailOrCreateAction
{
    public function execute(
        string $email,
        UserRegisteredAutoWhenCommentAdded|UserRegisteredAutoWhenIssueAdded|UserRegisteredAutoWhenSubscribing $userRegisteredEvent,
        UserFoundByEmailWhenCommentAdded|UserFoundByEmailWhenIssueAdded|UserFoundByEmailWhenSubscribing $userFoundEvent,
        UserStatus $status = UserStatus::Inactive,
    ) {
        if ($user = User::query()->firstWhere('email', $email)) {
            return $user;
        }

        if (str($email)->contains(Config::AutoregisterSuffixesBlacklist->get())) {
            throw EmailHostUnavailableForAutoRegistration::make();
        }

        $user = new User;
        $user->email = $email;
        $user->status = $status->value;
        $user->save();

        event(new \App\Events\Stats\UserRegisteredAuto);

        if ($user->wasRecentlyCreated) {
            event($userRegisteredEvent);
        } else {
            event($userFoundEvent);
        }

        return $user;
    }
}
