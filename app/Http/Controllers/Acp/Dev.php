<?php namespace App\Http\Controllers\Acp;

use Illuminate\Cookie\CookieJar;
use Ivacuum\Generic\Controllers\Acp\BaseController;

class Dev extends BaseController
{
    public function index()
    {
        return view($this->view);
    }

    public function debugbar(CookieJar $cookie)
    {
        $cookie->queue('debugbar', true, 60);

        return redirect(path("{$this->class}@index"))
            ->with('message', 'Debugbar включен на час');
    }

    // Для считывания последних строк лога
    // https://gist.github.com/lorenzos/1711e81a9162320fde20
    public function logs()
    {
        $log = \App::isLocal() ? public_path('uploads/access_log') : base_path('../../logs/access_log');
        $handle = fopen($log, 'r');
        $lines = collect();

        if ($handle) {
            while (false !== $line = fgets($handle)) {
                if (!is_null($json = json_decode($line))) {
                    $lines->push($json);
                }
            }

            fclose($handle);
        }

        return view($this->view, compact('lines'));
    }

    public function svg()
    {
        \Breadcrumbs::push(trans($this->view));

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
}
