<?php

namespace App\Observers;

use App\Domain\Avatar\Avatar;
use App\Domain\Life\Models\Photo;
use App\Domain\Locale;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\Telegram\Models\LinkRequest;
use App\Domain\Wanikani\Models\Burnable;
use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user): void
    {
        if ($user->getAttribute('locale') === null) {
            $user->locale = Locale::forNotification(\App::getLocale());
        }

        if (!$user->ip) {
            $user->ip = request()->ip();
        }
    }

    public function deleting(User $user): void
    {
        \DB::transaction(static function () use ($user) {
            Burnable::query()->where('user_id', $user->id)->delete();
            LinkRequest::query()->where('user_id', $user->id)->delete();
            SocialMediaPost::query()->where('user_id', $user->id)->delete();

            $user->chatMessages->each->delete();
            $user->comments->each->delete();
            $user->emails->each->delete();
            $user->externalIdentities->each->delete();
            $user->images->each->delete();
            $user->issues->each->delete();
            $user->magnets->each->delete();
            $user->news->each->delete();
            $user->receivedEmails->each->delete();
            $user->socialMediaTokens->each->delete();
            $user->trips->each->delete();

            Photo::query()->where('user_id', $user->id)->get()->each->delete();
        });
    }

    public function deleted(User $user): void
    {
        if ($user->avatar) {
            \DB::afterCommit(static fn () => app(Avatar::class)->delete($user->avatar));
        }
    }

    public function saving(User $user): void
    {
        if ($user->isDirty('password')) {
            $user->password_changed_at = now();
        }

        $this->maintainConsistency($user);
    }

    public function saved(User $user): void
    {
        if ($user->isDirty('avatar')) {
            $lastAvatar = $user->getOriginal('avatar');

            if ($lastAvatar) {
                app(Avatar::class)->delete($lastAvatar);
            }
        }
    }

    private function maintainConsistency(User $user): void
    {
        $user->ip = Str::trim($user->ip);
        $user->salt = Str::trim($user->salt);
        $user->email = Str::trim($user->email);
        $user->avatar = Str::trim($user->avatar);
        $user->locale ??= Locale::forNotification(config('app.locale'));

        if (filled($user->login)) {
            $user->login = Str::trim($user->login);
        }
    }
}
