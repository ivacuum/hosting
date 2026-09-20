<?php

namespace App\Http\Controllers\Acp;

class DevController
{
    public function svg()
    {
        $icons = [];

        foreach (glob(resource_path('svg/*.svg')) as $icon) {
            $icons[] = basename($icon, '.svg');
        }

        return view('acp.dev.svg', ['icons' => $icons]);
    }
}
