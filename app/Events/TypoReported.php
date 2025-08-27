<?php

namespace App\Events;

/**
 * Прислана информация об опечатке на странице
 */
class TypoReported
{
    public function __construct(public string $selection, public string $page) {}
}
