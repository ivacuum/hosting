<?php namespace App;

class GigFactory
{
    public static function forInputSelect()
    {
        return Gig::orderBy('slug')->pluck('slug', 'id');
    }
}
