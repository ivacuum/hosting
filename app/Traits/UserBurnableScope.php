<?php namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UserBurnableScope
{
    public function scopeUserBurnable(Builder $query, ?int $userId)
    {
        return $query->when($userId, function (Builder $query) use ($userId) {
            return $query->with(['burnable' => function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            }]);
        });
    }
}
