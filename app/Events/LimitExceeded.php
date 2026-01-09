<?php

namespace App\Events;

/**
 * Превышен лимит создания записей
 */
class LimitExceeded
{
    public function __construct(public string $title, public string $value) {}
}
