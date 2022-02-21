<?php namespace App\Observers;

use App\Avatar;
use App\Events\Stats;
use App\User as Model;

class UserObserver
{
    public function creating(Model $model)
    {
        if (!$model->locale) {
            $model->locale = \App::getLocale();
        }

        if (!$model->ip) {
            $model->ip = request()->ip();
        }
    }

    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->chatMessages->each->delete();
            $model->comments->each->delete();
            $model->externalIdentities->each->delete();
            $model->images->each->delete();
            $model->magnets->each->delete();
            $model->news->each->delete();
            $model->trips->each->delete();
        });
    }

    public function deleted(Model $model)
    {
        if ($model->avatar) {
            (new Avatar)->delete($model->avatar);
        }
    }

    public function saving(Model $model)
    {
        if ($model->isDirty('password')) {
            $model->password_changed_at = now();
        }
    }

    public function saved(Model $model)
    {
        if ($model->isDirty('avatar')) {
            $lastAvatar = $model->getOriginal('avatar');

            if ($lastAvatar) {
                (new Avatar)->delete($lastAvatar);
            }
        }

        if ($model->isDirty('notify_gigs')) {
            if ($model->notify_gigs->isEnabled()) {
                event(new Stats\GigsSubscribed);
            } elseif ($model->notify_gigs->isDisabled()) {
                event(new Stats\GigsUnsubscribed);
            }
        }

        if ($model->isDirty('notify_news')) {
            if ($model->notify_news->isEnabled()) {
                event(new Stats\NewsSubscribed);
            } elseif ($model->notify_news->isDisabled()) {
                event(new Stats\NewsUnsubscribed);
            }
        }

        if ($model->isDirty('notify_trips')) {
            if ($model->notify_trips->isEnabled()) {
                event(new Stats\TripsSubscribed);
            } elseif ($model->notify_trips->isDisabled()) {
                event(new Stats\TripsUnsubscribed);
            }
        }
    }
}
