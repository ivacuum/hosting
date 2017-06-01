<?php namespace App\Http\Controllers\Acp;

use App\Page as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

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

                Model::whereIn('id', $pages)->update(['status' => 1]);

            break;
            case 'deactivate':

                Model::whereIn('id', $pages)->update(['status' => 0]);

            break;
            case 'delete':

                Model::destroy($pages);

            break;
        }

        return 'ok';
    }

    public function move()
    {
        $how = $this->request->input('how');
        $what = $this->request->input('what');
        $where = $this->request->input('where');

        switch ($how) {
            case 'over': $method = 'makeChildOf'; break;
            case 'after': $method = 'moveToRightOf'; break;
            case 'before': $method = 'moveToLeftOf'; break;
            default: die('something very strange');
        }

        Model::find($what)->$method($where);

        return 'ok';
    }

    public function tree()
    {
        return $this->getHierarchy(Model::get()->toHierarchy()->toArray());
    }

    protected function getHierarchy($pages)
    {
        $ary = [];

        foreach ($pages as $page) {
            $ary[] = [
                'key'       => $page['id'],
                'expanded'  => true,
                'activated' => $page['status'],
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

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'url' => [
                'required',
                Rule::unique('pages', 'url')->ignore($model->id ?? null),
            ],
            'title' => 'required',
            'status' => 'boolean',
        ];
    }
}
