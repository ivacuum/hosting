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
            $model->news->each->delete();
            $model->torrents->each->delete();
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
            $last_avatar = $model->getOriginal('avatar');

            if ($last_avatar) {
                (new Avatar)->delete($last_avatar);
            }
        }

        if ($model->isDirty('notify_gigs')) {
            if ($model->notify_gigs === Model::NOTIFY_MAIL) {
                event(new Stats\GigsSubscribed);
            } elseif ($model->notify_gigs === Model::NOTIFY_NO) {
                event(new Stats\GigsUnsubscribed);
            }
        }

        if ($model->isDirty('notify_news')) {
            if ($model->notify_news === Model::NOTIFY_MAIL) {
                event(new Stats\NewsSubscribed);
            } elseif ($model->notify_news === Model::NOTIFY_NO) {
                event(new Stats\NewsUnsubscribed);
            }
        }

        if ($model->isDirty('notify_trips')) {
            if ($model->notify_trips === Model::NOTIFY_MAIL) {
                event(new Stats\TripsSubscribed);
            } elseif ($model->notify_trips === Model::NOTIFY_NO) {
                event(new Stats\TripsUnsubscribed);
            }
        }
    }
}
