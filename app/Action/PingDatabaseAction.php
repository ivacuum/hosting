<?php

namespace App\Action;

use Illuminate\Database\Connection;
use Illuminate\Support\Sleep;

class PingDatabaseAction
{
    public function __construct(private Connection $db) {}

    /**
     * Переподключение в Laravel ленивое, поэтому успех проверяется повторным запросом.
     */
    public function execute(): void
    {
        if ($this->ping()) {
            return;
        }

        $this->db->reconnect();

        while (!$this->ping()) {
            Sleep::for(5)->seconds();
            $this->db->reconnect();
        }
    }

    /** @phpstan-impure */
    private function ping(): bool
    {
        try {
            $this->db->statement('DO 1');

            return true;
        } catch (\PDOException) {
            return false;
        }
    }
}
