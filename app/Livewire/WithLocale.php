<?php

namespace App\Livewire;

use Illuminate\View\View;

trait WithLocale
{
    public function renderingWithLocale(View $view)
    {
        $view->with('locale', request()->server->get('LARAVEL_LOCALE') ?: config('app.locale'));
    }
}
