<?php

namespace App\Domain\SocialMedia\Action;

use App\Domain\Life\Models\Photo;
use App\Domain\Life\Models\Trip;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class PickRandomPhotoAction
{
    public function execute(User $user, int|null $skipId = null): Photo
    {
        $randomId = Photo::query()
            ->whereBelongsTo($user)
            ->where('rel_type', new Trip()->getMorphClass())
            ->when($skipId, static fn (Builder $query) => $query->where('id', '<>', $skipId))
            ->doesntHave('socialMediaPost')
            ->inRandomOrder()
            ->firstOrFail(['id'])
            ->id;

        return Photo::query()->findOrFail($randomId);
    }
}
