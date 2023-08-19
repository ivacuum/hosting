<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasLocalizedTitle
{
    public static function titleField(): string
    {
        return 'title_' . \App::getLocale();
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->{static::titleField()},
        );
    }
}
