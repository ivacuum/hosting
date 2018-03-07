<?php namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UserBurnableScope
{
    public function scopeUserBurnable(Builder $query, ?int $user_id)
    {
        return $query->when($user_id, function (Builder $query) use ($user_id) {
            return $query->with(['burnable' => function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
            }]);
        });
    }
}
