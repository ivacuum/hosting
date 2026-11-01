<?php

namespace App\Domain\Wanikani\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class UserBurnableScope
{
    public function __construct(private int|null $userId = null) {}

    public function __invoke(Builder $query): void
    {
        if ($this->userId === null) {
            return;
        }

        $query->with(['burnable' => fn (Relation $query) => $query->where('user_id', $this->userId)]);
    }
}
