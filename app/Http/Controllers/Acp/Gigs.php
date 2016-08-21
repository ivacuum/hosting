<?php namespace App\Http\Controllers\Acp;

use App\Gig;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\GigCreate;
use App\Http\Requests\Acp\GigEdit;
use Breadcrumbs;

class Gigs extends Controller
{
    public function index()
    {
        $gigs = Gig::orderBy('date', 'desc')->get();

        return view($this->view, compact('gigs'));
    }

    public function create()
    {
        Breadcrumbs::push('Добавление');

        $this->appendTemplates();

        return view($this->view);
    }

    public function destroy(Gig $gig)
    {
        $gig->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function edit(Gig $gig)
    {
        Breadcrumbs::push($gig->title, "acp/gigs/{$gig->id}");
        Breadcrumbs::push('Редактирование');

        $this->appendTemplates();

        return view($this->view, compact('gig'));
    }

    public function show(Gig $gig)
    {
        Breadcrumbs::push($gig->title);

        return view($this->view, compact('gig'));
    }

    public function store(GigCreate $request)
    {
        Gig::create($request->all());

        return redirect()->action("{$this->class}@index");
    }

    public function update(Gig $gig, GigEdit $request)
    {
        $gig->update($request->all());

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$gig, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $gig);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
    }

    protected function appendTemplates()
    {
        $templates = [];

        foreach (glob(base_path('resources/views/life/gigs/*.blade.php')) as $template) {
            $info = pathinfo($template);
            $filename = str_replace('.blade.php', '', $info['basename']);

            if ($filename == 'base') {
                continue;
            }

            $templates[] = $filename;
        }

        view()->share(compact('templates'));
    }
}
