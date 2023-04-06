<?php namespace App\Exceptions;

use Illuminate\Database\QueryException;

class SkipDatabaseOffline
{
    public function __invoke(QueryException $e): bool
    {
        return !$this->isDatabaseOffline($e);
    }

    private function isDatabaseOffline(\Throwable $e): bool
    {
        if ($e instanceof QueryException && $e->getCode() === 2002) {
            return true;
        }

        // QueryException может быть не на верхнем уровне, а, например, на третьем
        if ($previous = $e->getPrevious()) {
            return $this->isDatabaseOffline($previous);
        }

        return false;
    }
}
