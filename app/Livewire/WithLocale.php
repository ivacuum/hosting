<?php

namespace App\Livewire;

use App\Domain\Config;
use Illuminate\View\View;

trait WithLocale
{
    public function renderingWithLocale(View $view)
    {
        $view->with('locale', request()->server->get('LARAVEL_LOCALE') ?: Config::Locale->get());
    }
}
