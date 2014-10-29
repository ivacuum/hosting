<?php

class BaseController extends Controller
{
	protected $method;
	protected $prefix;
	protected $view;
	
	public function __construct()
	{
		$this->method = $this->getCurrentMethod();
		$this->prefix = strtolower(str_replace('\\', '.', get_class($this)));
		$this->view   = "{$this->prefix}.{$this->method}";
		
		$this->beforeFilter(function() {
			View::share([
				'self' => get_class($this),
				'tpl'  => $this->prefix,
			]);
		});
	}
	
	protected function getCurrentMethod()
	{
		$method = Route::currentRouteAction();
		
		return substr($method, strpos($method, '@') + 1);
	}
	
	protected function setupLayout()
	{
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}
}
