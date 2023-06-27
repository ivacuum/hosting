<?php

namespace App\Action;

use Illuminate\Database\Connection;

class PingDatabaseAction
{
    public function __construct(private Connection $db)
    {
    }

    public function execute(): void
    {
        try {
            $this->db->statement('DO 1');
        } catch (\PDOException) {
            reconnect:
            try {
                $this->db->reconnect();
            } catch (\PDOException) {
                sleep(5);
                goto reconnect;
            }
        }
    }
}
