<?php namespace App\Domain;

trait PingsDatabase
{
    protected function pingDatabase(): void
    {
        try {
            \DB::statement('DO 1');
        } catch (\PDOException) {
            reconnect:
            try {
                \DB::reconnect();
            } catch (\PDOException) {
                sleep(5);
                goto reconnect;
            }
        }
    }
}
