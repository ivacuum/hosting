<?php namespace Acp;

use Client;
use Redirect;
use View;

class Clients extends \BaseController
{
	public function index()
	{
		return View::make('acp.clients.index')
			->withClients(Client::get());
	}
	
	public function create()
	{
		return View::make('acp.clients.create');
	}
	
	public function destroy(Client $client)
	{
		$client->delete();
		
		return Redirect::route('acp.clients.index');
	}
	
	public function edit(Client $client)
	{
		return View::make('acp.clients.edit')
			->with(compact('client'));
	}
	
	public function show(Client $client)
	{
		return View::make('acp.clients.show')
			->with(compact('client'));
	}
	
	public function store()
	{
		$client = Client::create(Input::all());
		
		return Redirect::route('acp.clients.show', $client->id);
	}
	
	public function update(Client $client)
	{
		$client->update(Input::all());
		
		return Redirect::route('acp.clients.index');
	}
}
