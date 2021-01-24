<?php namespace App\Events;

/**
 * Прислана информация об опечатке на странице
 *
 * @property string $page
 * @property string $selection
 */
class TypoReceived extends Event
{
    public function __construct(public string $selection, public string $page)
    {
    }
}
