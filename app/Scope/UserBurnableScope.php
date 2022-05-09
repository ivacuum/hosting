<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class UserBurnableScope
{
    public function __construct(private ?int $userId = null)
    {
    }

    public function __invoke(Builder $query)
    {
        if ($this->userId === null) {
            return;
        }

        $query->with(['burnable' => fn (MorphOne $query) => $query->where('user_id', $this->userId)]);
    }
}
