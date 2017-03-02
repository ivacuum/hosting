<?php namespace App\Http\Controllers\Acp;

use App\Http\Requests\Acp\PageCreate as ModelCreate;
use App\Http\Requests\Acp\PageEdit as ModelEdit;
use App\Page as Model;

class Pages extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function batch()
    {
        $action = $this->request->input('action');
        $pages  = $this->request->input('pages');

        switch ($action) {
            case 'activate':

                Model::whereIn('id', $pages)->update(['active' => 1]);

            break;
            case 'deactivate':

                Model::whereIn('id', $pages)->update(['active' => 0]);

            break;
            case 'delete':

                Model::destroy($pages);

            break;
        }

        return 'ok';
    }

    public function create()
    {
        return view('acp.create');
    }

    public function destroy(Model $model)
    {
        $model->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function edit(Model $model)
    {
        return view('acp.edit', compact('model'));
    }

    public function move()
    {
        $what  = $this->request->input('what');
        $how   = $this->request->input('how');
        $where = $this->request->input('where');

        switch ($how) {
            case 'before': $method = 'moveToLeftOf'; break;
            case 'after':  $method = 'moveToRightOf'; break;
            case 'over':   $method = 'makeChildOf'; break;
            default: die('something very strange');
        }

        Model::find($what)->$method($where);

        return 'ok';
    }

    public function show(Model $model)
    {
        return view($this->view, compact('model'));
    }

    public function store(ModelCreate $request)
    {
        $model = Model::create($request->all());

        return redirect()->action("{$this->class}@show", $model);
    }

    public function tree()
    {
        return $this->getHierarchy(Model::get()->toHierarchy()->toArray());
    }

    public function update(Model $model, ModelEdit $request)
    {
        $model->update($request->all());

        return $this->redirectAfterUpdate($model);
    }

    protected function getHierarchy($pages)
    {
        $ary = [];

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
