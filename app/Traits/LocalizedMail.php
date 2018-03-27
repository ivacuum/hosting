<?php namespace App\Traits;

trait LocalizedMail
{
    protected $original_locale;

    public function __destruct()
    {
        if ($this->original_locale) {
            \App::setLocale($this->original_locale);
        }
    }

    public function setLocale(string $new)
    {
        $prev = \App::getLocale();

        if ($prev !== $new) {
            $this->original_locale = $prev;

            \App::setLocale($new);
        }
    }
}
