<?php

namespace App\Domain;

trait PingsDatabase
{
    protected function pingDatabase(): void
    {
        try {
            \DB::statement('DO 1');
        } catch (\PDOException $e) {
            reconnect:
            try {
                \DB::reconnect();
            } catch (\PDOException $e) {
                sleep(5);
                goto reconnect;
            }
        }
    }
}
