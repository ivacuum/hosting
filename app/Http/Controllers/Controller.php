<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Input;
use Route;

abstract class Controller extends BaseController
{
	use DispatchesCommands, ValidatesRequests;

	protected $class;
	protected $method;
	protected $prefix;
	protected $view;

	public function __construct()
	{
		$this->class  = str_replace('App\Http\Controllers\\', '', get_class($this));
		$this->method = $this->getCurrentMethod();
		$this->prefix = $this->getViewPrefix();
		$this->view   = $this->prefix.".".snake_case($this->method);
		
		$this->appendViewSharedVars();
	}
	
	protected function appendViewSharedVars()
	{
		view()->share([
			'goto' => Input::get('goto'),
			'self' => $this->class,
			'tpl'  => $this->prefix,
		]);
	}

	protected function getCurrentMethod()
	{
		$method = Route::currentRouteAction();
		
		return substr($method, strpos($method, '@') + 1);
	}
	
	protected function getViewPrefix()
	{
		return strtolower(str_replace(
			['App\Http\Controllers\\', '\\'],
			['', '.'],
			$this->class
		));
	}
}
