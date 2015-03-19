<?php namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\UserCreate;
use App\Http\Requests\Acp\UserEdit;
use App\User;
use Mail;
use Session;

class Users extends Controller
{
	public function index()
	{
		return view($this->view)
			->withUsers(User::get());
	}
	
	public function create()
	{
		return view($this->view);
	}
	
	public function destroy(User $user)
	{
		$user->delete();
		
		return redirect()->action("{$this->class}@index");
	}
	
	public function edit(User $user)
	{
		return view($this->view, compact('user'));
	}
	
	public function show(User $user)
	{
		return view($this->view, compact('user'));
	}
	
	public function store(UserCreate $request)
	{
		extract($request->only('password', 'random_password'));
		
		$password = $random_password ? str_random(16) : $password;
		
		$user = new User;
		$user->email    = $request->get('email');
		$user->password = $password;
		$user->active   = $request->get('active', 0);
		$user->is_admin = $request->get('is_admin', 0);
		$user->save();
		
		if ($request->get('mail_credentials')) {
			$this->mailCredentials($user, $password);
		}
		
		return redirect()->action("{$this->class}@show", $user);
	}
	
	public function update(User $user, UserEdit $request)
	{
		extract($request->only('password', 'random_password', 'mail_credentials'));
		
		$password = $random_password ? str_random(16) : $password;
		
		$user->email    = $request->get('email');
		$user->active   = $request->get('active', 0);
		$user->is_admin = $request->get('is_admin', 0);
		
		if ($password) {
			$user->password = $password;
		}
		
		$user->save();
		
		if ($password && $mail_credentials) {
			$this->mailCredentials($user, $password);
		}
		
		$goto = $request->get('goto', '');
		
		return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
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
