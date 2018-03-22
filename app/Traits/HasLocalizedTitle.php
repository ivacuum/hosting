<?php namespace App\Traits;

trait HasLocalizedTitle
{
    public function getTitleAttribute(): string
    {
        return $this->{static::titleField()};
    }

    public static function titleField(): string
    {
        return 'title_'.\App::getLocale();
    }
}
