<?php namespace App\Http\Controllers\Acp;

use Breadcrumbs;
use Illuminate\Cookie\CookieJar;

class Dev extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function debugbar(CookieJar $cookie)
    {
        $cookie->queue('debugbar', true, 60);

        return redirect()->action("{$this->class}@index")
            ->with('message', 'Debugbar включен на час');
    }

    public function svg()
    {
        $icons = [];

        foreach (glob(base_path('resources/svg/*.html')) as $icon) {
            $info = pathinfo($icon);
            $filename = str_replace('.html', '', $info['basename']);

            if ($filename == 'base') {
                continue;
            }

            $icons[] = $filename;
        }

        return view($this->view, compact('icons'));
    }

    protected function breadcrumbsSvg()
    {
        Breadcrumbs::push(trans($this->view));
    }
}
