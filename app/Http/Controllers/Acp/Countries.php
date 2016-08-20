<?php namespace App\Http\Controllers\Acp;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\CountryCreate;
use App\Http\Requests\Acp\CountryEdit;
use Breadcrumbs;

class Countries extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('title_ru')->get();

        return view($this->view, compact('countries'));
    }

    public function create()
    {
        Breadcrumbs::push('Добавление');

        return view($this->view);
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function edit(Country $country)
    {
        Breadcrumbs::push($country->title, "acp/countries/{$country->id}");
        Breadcrumbs::push('Редактирование');

        return view($this->view, compact('country'));
    }

    public function show(Country $country)
    {
        Breadcrumbs::push($country->title);

        return view($this->view, compact('country'));
    }

    public function store(CountryCreate $request)
    {
        Country::create($request->all());

        return redirect()->action("{$this->class}@index");
    }

    public function update(Country $country, CountryEdit $request)
    {
        $country->update($request->all());

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$country, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $country);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
    }
}
