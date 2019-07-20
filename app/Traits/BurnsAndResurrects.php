<?php namespace App\Traits;

use App\Burnable;
use Illuminate\Database\QueryException;

trait BurnsAndResurrects
{
    public function burn(int $userId): ?Burnable
    {
        try {
            return $this->burnable()->create(['user_id' => $userId]);
        } catch (QueryException $e) {
            return null;
        }
    }

    public function resurrect(int $userId): int
    {
        return $this->burnable()->where('user_id', $userId)->delete();
    }
}
