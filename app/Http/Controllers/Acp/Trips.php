<?php namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\TripCreate;
use App\Http\Requests\Acp\TripEdit;
use App\Trip;
use Breadcrumbs;

class Trips extends Controller
{
    public function index()
    {
        $trips = Trip::orderBy('date_start', 'desc')->get();

        return view($this->view, compact('trips'));
    }

    public function create()
    {
        Breadcrumbs::push('Добавление');

        $this->appendTemplates();

        return view($this->view);
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function edit(Trip $trip)
    {
        Breadcrumbs::push($trip->title, "acp/trips/{$trip->id}");
        Breadcrumbs::push('Редактирование');

        $this->appendTemplates();

        return view($this->view, compact('trip'));
    }

    public function show(Trip $trip)
    {
        Breadcrumbs::push($trip->title);

        return view($this->view, compact('trip'));
    }

    public function store(TripCreate $request)
    {
        Trip::create($request->all());

        return redirect()->action("{$this->class}@index");
    }

    public function update(Trip $trip, TripEdit $request)
    {
        $trip->update($request->all());

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$trip, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $trip);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
    }

    protected function appendTemplates()
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

        view()->share(compact('templates'));
    }
}
