<?php namespace App;

class GigFactory
{
    public static function forInputSelect()
    {
        return Gig::orderByDesc('date')->pluck('slug', 'id');
    }
}
