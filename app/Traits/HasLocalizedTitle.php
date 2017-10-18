<?php namespace App\Traits;

trait HasLocalizedTitle
{
    public function getTitleAttribute(): string
    {
        return $this->{self::titleField()};
    }

    public static function titleField(): string
    {
        return 'title_'.\App::getLocale();
    }
}
