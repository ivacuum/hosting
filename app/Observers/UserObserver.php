<?php

namespace App\Observers;

use App\Avatar;
use App\Events\Stats;
use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        if (!$user->locale) {
            $user->locale = \App::getLocale();
        }

        if (!$user->ip) {
            $user->ip = request()->ip();
        }
    }

    public function deleting(User $user)
    {
        \DB::transaction(function () use ($user) {
            $user->chatMessages->each->delete();
            $user->comments->each->delete();
            $user->externalIdentities->each->delete();
            $user->images->each->delete();
            $user->magnets->each->delete();
            $user->news->each->delete();
            $user->trips->each->delete();
        });
    }

    public function deleted(User $user)
    {
        if ($user->avatar) {
            (new Avatar)->delete($user->avatar);
        }
    }

    public function saving(User $user)
    {
        if ($user->isDirty('password')) {
            $user->password_changed_at = now();
        }
    }

    public function saved(User $user)
    {
        if ($user->isDirty('avatar')) {
            $lastAvatar = $user->getOriginal('avatar');

            if ($lastAvatar) {
                (new Avatar)->delete($lastAvatar);
            }
        }

        if ($user->isDirty('notify_gigs')) {
            if ($user->notify_gigs->isEnabled()) {
                event(new Stats\GigsSubscribed);
            } elseif ($user->notify_gigs->isDisabled()) {
                event(new Stats\GigsUnsubscribed);
            }
        }

        if ($user->isDirty('notify_news')) {
            if ($user->notify_news->isEnabled()) {
                event(new Stats\NewsSubscribed);
            } elseif ($user->notify_news->isDisabled()) {
                event(new Stats\NewsUnsubscribed);
            }
        }

        if ($user->isDirty('notify_trips')) {
            if ($user->notify_trips->isEnabled()) {
                event(new Stats\TripsSubscribed);
            } elseif ($user->notify_trips->isDisabled()) {
                event(new Stats\TripsUnsubscribed);
            }
        }
    }
}
