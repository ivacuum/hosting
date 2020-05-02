<?php namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait UserBurnableScope
{
    public function scopeUserBurnable(Builder $query, ?int $userId)
    {
        if ($userId === null) {
            return $query;
        }

        return $query->with(['burnable' => fn (MorphOne $query) => $query->where('user_id', $userId)]);
    }
}
