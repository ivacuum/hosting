<?php

namespace App\Events;

/**
 * Прислана информация об опечатке на странице
 */
class TypoReported extends Event
{
    public function __construct(public string $selection, public string $page)
    {
    }
}
