<?php

namespace App\Domain\Sphinx;

use Foolz\SphinxQL\Drivers\Pdo\Connection;
use Illuminate\Database\DetectsLostConnections;

class SphinxPdoConnection extends Connection
{
    use DetectsLostConnections;

    #[\Override]
    public function ping()
    {
        $result = parent::ping();

        $stm = $this->connection->prepare('SELECT 1');

        try {
            $stm->execute();
        } catch (\Throwable $e) {
            if ($this->causedByLostConnection($e)) {
                $this->connect();
            }
        }

        return $result;
    }
}
