<?php namespace App\Http\Controllers\Acp;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\ClientCreate;
use App\Http\Requests\Acp\ClientEdit;
use Illuminate\Http\Request;

class Clients extends Controller
{
	public function index()
	{
		return view($this->view)
			->withClients(Client::get());
	}
	
	public function create()
	{
		return view($this->view);
	}
	
	public function destroy(Client $client)
	{
		$client->delete();
		
		return redirect()->action("{$this->class}@index");
	}
	
	public function edit(Client $client)
	{
		return view($this->view, compact('client'));
	}
	
	public function show(Client $client, Request $request)
	{
		$filter = '';
		$q = $request->get('q');

		$domains = $client->domains()->orderBy('paid_till');
		
		if ($q) {
			$domains = $domains->where('domain', 'LIKE', "%{$q}%");
		}

		$client->domains = $domains->paginate()
			->appends(compact('q'));
		
		return view($this->view, compact('client', 'filter', 'q'));
	}
	
	public function store(ClientCreate $request)
	{
		$client = Client::create($request->all());
		
		return redirect()->action("{$this->class}@show", $client);
	}
	
	public function update(Client $client, ClientEdit $request)
	{
		$client->update($request->all());

		$goto = $request->get('goto', '');

		return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
	}
}
