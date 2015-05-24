<?php namespace App\Breadcrumbs;

use Illuminate\Routing\Router;

class Breadcrumbs
{
	protected $breadcrumbs = [];
	protected $router;
	
	public function __construct(Router $router)
	{
		$this->router = $router;
	}
	
	public function get()
	{
		return $this->breadcrumbs;
	}
	
	public function parseRoutes()
	{
		$action = $this->router->current()->getAction();
		$breadcrumbs = array_get($action, 'breadcrumbs');
		
		if (!empty($breadcrumbs)) {
			foreach ($breadcrumbs as $breadcrumb) {
				call_user_func_array([$this, 'push'], $breadcrumb);
			}
		}
	}
	
	public function push($title, $url = false, $image = false)
	{
		$this->breadcrumbs[] = compact('title', 'url', 'image');
	}
}
