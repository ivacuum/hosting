<?php

namespace App\Domain\SocialMedia\Action;

use App\Photo;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class PickRandomPhotoAction
{
    public function execute(User $user, int|null $skipId = null)
    {
        $randomId = Photo::query()
            ->whereBelongsTo($user)
            ->when($skipId, fn (Builder $query) => $query->where('id', '<>', $skipId))
            ->doesntHave('socialMediaPost')
            ->inRandomOrder()
            ->firstOrFail(['id'])
            ->id;

        return Photo::query()
            ->where('id', '>=', $randomId)
            ->first();
    }
}
