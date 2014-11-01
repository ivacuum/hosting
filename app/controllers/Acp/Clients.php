<?php namespace Acp;

use BaseController;
use Client;
use Input;
use Redirect;
use Validator;
use View;

class Clients extends BaseController
{
	public function index()
	{
		return View::make($this->view)
			->withClients(Client::get());
	}
	
	public function create()
	{
		return View::make($this->view);
	}
	
	public function destroy(Client $client)
	{
		$client->delete();
		
		return Redirect::action("{$this->class}@index");
	}
	
	public function edit(Client $client)
	{
		return View::make($this->view, compact('client'));
	}
	
	public function show(Client $client)
	{
		return View::make($this->view, compact('client'));
	}
	
	public function store()
	{
		$validator = Validator::make(Input::all(), Client::rules());
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@create")
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$client = Client::create(Input::all());
		
		return Redirect::action("{$this->class}@show", $client->id);
	}
	
	public function update(Client $client)
	{
		$validator = Validator::make(Input::all(), Client::rules($client->id));
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@edit", $client->id)
				->withErrors($validator)
				->withInput(Input::all());
		}

		$client->update(Input::all());

		return Redirect::action("{$this->class}@index");
	}
}
