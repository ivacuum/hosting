<?php namespace App\Http\Controllers\Acp;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\CityCreate;
use App\Http\Requests\Acp\CityEdit;
use Breadcrumbs;

class Cities extends Controller
{
	public function index()
	{
        $cities = City::with('country')
            ->orderBy('title')
            ->get();

		return view($this->view, compact('cities'));
	}

	public function create()
	{
        Breadcrumbs::push('Добавление');

		return view($this->view);
	}

	public function destroy(City $city)
	{
		$city->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
	}

	public function edit(City $city)
	{
        Breadcrumbs::push($city->title, "acp/cities/{$city->slug}");
        Breadcrumbs::push('Редактирование');

		return view($this->view, compact('city'));
	}

	public function show(City $city)
	{
        Breadcrumbs::push($city->title);

		return view($this->view, compact('city'));
	}

	public function store(CityCreate $request)
	{
		City::create($request->all());

		return redirect()->action("{$this->class}@index");
	}

	public function update(City $city, CityEdit $request)
	{
		$city->update($request->all());

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$city, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $city);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
	}
}
