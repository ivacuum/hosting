<?php namespace App\Http\Controllers\Acp\Dev;

use App\Http\Controllers\Acp\Controller;
use App\Trip;
use Breadcrumbs;

class Templates extends Controller
{
    public function index()
    {
        $templates = [];

        foreach (glob(base_path('resources/views/life/trips/*.blade.php')) as $template) {
            $info = pathinfo($template);
            $filename = str_replace('.blade.php', '', $info['basename']);

            if ($filename == 'base') {
                continue;
            }

            $templates[] = $filename;
        }

        return view($this->view, compact('templates'));
    }

    public function template($template)
    {
        $slug = str_replace('_', '.', $template);

        $trip = Trip::inRandomOrder()->first();
        $trip->slug = $slug;

        return view($this->view, compact('template', 'trip'));
    }

    protected function breadcrumbsTemplate($template)
    {
        Breadcrumbs::push($template);
    }
}
