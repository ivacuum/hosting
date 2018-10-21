<?php namespace App\Traits;

use App\Burnable;
use Illuminate\Database\QueryException;

trait BurnsAndResurrects
{
    public function burn(int $user_id): ?Burnable
    {
        try {
            return $this->burnable()->create(['user_id' => $user_id]);
        } catch (QueryException $e) {
            return null;
        }
    }

    public function resurrect(int $user_id): int
    {
        return $this->burnable()->where('user_id', $user_id)->delete();
    }
}
