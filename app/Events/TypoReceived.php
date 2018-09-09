<?php namespace App\Events;

/**
 * Прислана информация об опечатке на странице
 *
 * @property string $page
 * @property string $selection
 */
class TypoReceived extends Event
{
    public $page;
    public $selection;

    public function __construct(string $selection, string $page)
    {
        $this->page = $page;
        $this->selection = $selection;
    }
}
