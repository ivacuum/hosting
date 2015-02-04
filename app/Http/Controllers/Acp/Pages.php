<?php namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Acp\PageCreate;
use App\Http\Requests\Acp\PageEdit;
use App\Page;
use Illuminate\Http\Request;

class Pages extends Controller
{
	public function index()
	{
		return view($this->view);
	}
	
	public function batch(Request $request)
	{
		extract($request->only('action', 'pages'));
		
		switch ($action) {
			case 'activate':
			
				Page::whereIn('id', $pages)->update(['active' => 1]);
			
			break;
			case 'deactivate':
			
				Page::whereIn('id', $pages)->update(['active' => 0]);

			break;
			case 'delete':
			
				Page::destroy($pages);

			break;
		}
		
		return 'ok';
	}
	
	public function create()
	{
		return view($this->view);
	}
	
	public function destroy(Page $page)
	{
		$page->delete();
		
		return redirect()->action("{$this->class}@index");
	}
	
	public function edit(Page $page)
	{
		return view($this->view, compact('page'));
	}
	
	public function move(Request $request)
	{
		extract($request->only('what', 'how', 'where'));
		
		switch ($how) {
			case 'before': $method = 'moveToLeftOf'; break;
			case 'after':  $method = 'moveToRightOf'; break;
			case 'over':   $method = 'makeChildOf'; break;
			default: die('something very strange');
		}
		
		Page::find($what)->$method($where);
		
		return 'ok';
	}
	
	public function show(Page $page)
	{
		return view($this->view, compact('page'));
	}
	
	public function store(PageCreate $request)
	{
		$page = Page::create($request->all());
		
		return redirect()->action("{$this->class}@show", $page->id);
	}
	
	public function tree()
	{
		return response()->json($this->getHierarchy(Page::get()->toHierarchy()->toArray()));
	}
	
	public function update(Page $page, PageEdit $request)
	{
		$page->update($request->all());

		$goto = $request->get('goto', '');

		return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
	}
	
	protected function getHierarchy($pages)
	{
		foreach ($pages as $page) {
			$ary[] = [
				'key'       => $page['id'],
				'expanded'  => true,
				'activated' => $page['active'],
				'title'     => $page['title'],
				'url'       => "/{$page['url']}",
				'handler'   => $page['handler'] && $page['method'] ? "{$page['handler']}@{$page['method']}" : '',
				'redirect'  => $page['redirect'],
				'noindex'   => $page['noindex'],
				'edit_url'  => "/acp/pages/{$page['id']}/edit",
				'show_url'  => "/acp/pages/{$page['id']}",
				'children'  => sizeof($page['children']) ? $this->getHierarchy($page['children']) : [],
			];
		}
		
		return $ary;
	}
}
