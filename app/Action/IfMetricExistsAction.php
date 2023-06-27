<?php

namespace App\Action;

class IfMetricExistsAction
{
    public function execute(string $event): bool
    {
        try {
            new \ReflectionClass("App\Events\Stats\\$event");

            return true;
        } catch (\Throwable) {
        }

        return false;
    }
}
