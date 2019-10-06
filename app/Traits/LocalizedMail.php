<?php namespace App\Traits;

trait LocalizedMail
{
    protected $originalLocale;

    public function __destruct()
    {
        if ($this->originalLocale) {
            \App::setLocale($this->originalLocale);
        }
    }

    public function setLocale(string $new)
    {
        $prev = \App::getLocale();

        if ($prev !== $new) {
            $this->originalLocale = $prev;

            \App::setLocale($new);
        }
    }
}
