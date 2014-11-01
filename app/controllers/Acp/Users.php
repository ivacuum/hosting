<?php namespace Acp;

use BaseController;
use Input;
use Mail;
use Redirect;
use Session;
use Validator;
use View;
use User;

class Users extends BaseController
{
	public function index()
	{
		return View::make($this->view)
			->withUsers(User::get());
	}
	
	public function create()
	{
		return View::make($this->view);
	}
	
	public function destroy(User $user)
	{
		$user->delete();
		
		return Redirect::action("{$this->class}@index");
	}
	
	public function edit(User $user)
	{
		return View::make($this->view, compact('user'));
	}
	
	public function show(User $user)
	{
		return View::make($this->view, compact('user'));
	}
	
	public function store()
	{
		extract(Input::only('password', 'random_password'));
		
		$password = $random_password ? str_random(16) : $password;
		
		$validator = Validator::make(Input::all(), User::rules());
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@create")
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$user = new User;
		$user->email    = Input::get('email');
		$user->password = $password;
		$user->active   = Input::get('active', 0);
		$user->save();
		
		if (Input::get('mail_credentials')) {
			$this->mailCredentials($user, $password);
		}
		
		return Redirect::action("{$this->class}@show", $user->id);
	}
	
	public function update(User $user)
	{
		extract(Input::only('password', 'random_password', 'mail_credentials'));
		
		$password = $random_password ? str_random(16) : $password;

		$validator = Validator::make(
			Input::all(),
			User::rules($user->id, $password)
		);
		
		if ($validator->fails()) {
			return Redirect::action("{$this->class}@edit", $user->id)
				->withErrors($validator)
				->withInput(Input::all());
		}
		
		$user->email  = Input::get('email');
		$user->active = Input::get('active', 0);
		
		if ($password) {
			$user->password = $password;
		}
		
		$user->save();
		
		if ($password && $mail_credentials) {
			$this->mailCredentials($user, $password);
		}
		
		$goto = Input::get('goto', '');

		return $goto ? Redirect::to($goto) : Redirect::action("{$this->class}@index");
	}
	
	protected function mailCredentials(User $user, $password)
	{
		$route = action('Acp\Home@index');
		$vars  = compact('user', 'password', 'route');
		
		Mail::send('emails.users.credentials', $vars, function($mail) use ($user, $route) {
			$mail->to($user->email)->subject("Доступ к {$route}");
		});

		Session::flash('message', "Данные высланы на почту {$user->email}");
	}
}
