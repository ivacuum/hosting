<?php namespace App\Http\Controllers\Acp;

use App\Server;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\ServerCreate;
use App\Http\Requests\Acp\ServerEdit;

class Servers extends Controller
{
	public function index()
	{
		return view($this->view)
			->withServers(Server::get());
	}

	public function create()
	{
		return view($this->view);
	}

	public function destroy(Server $server)
	{
		$server->delete();

		return redirect()->action("{$this->class}@index");
	}

	public function edit(Server $server)
	{
		return view($this->view, compact('server'));
	}

	public function show(Server $server)
	{
		return view($this->view, compact('server'));
	}

	public function store(ServerCreate $request)
	{
		$server = Server::create($request->all());

		return redirect()->action("{$this->class}@show", $server->id);
	}

	public function update(Server $server, ServerEdit $request)
	{
		$input = $request->all();

		/* Сохранение ранее указанного пароля */
		$passwords = $request->only('ftp_pass');

		foreach ($passwords as $key => $value) {
			if (!$value) {
				unset($input[$key]);
			}
		}

		$server->update($input);

		$goto = $request->input('goto', '');

		return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
	}
}
