<?php namespace App\Http\Controllers\Acp;

class CommonController extends Controller
{
    protected $show_with_count;

    public function create()
    {
        $model = $this->createGeneric();

        return view($this->getView(), compact('model'));
    }

    public function createGeneric()
    {
        $model = $this->newModel();

        $this->authorize('create', $model);
        $this->breadcrumbsCreate();

        return $model;
    }

    public function destroy($id)
    {
        $model = $this->destroyGeneric($id);

        $this->destroyModel($model);

        return $this->redirectAfterDestroy();
    }

    public function destroyGeneric($id)
    {
        $model = $this->getModel($id);

        $this->authorize('destroy', $model);

        return $model;
    }

    public function edit($id)
    {
        $model = $this->editGeneric($id);

        return view($this->getView(), compact('model'));
    }

    public function editGeneric($id)
    {
        $model = $this->getModel($id);

        $this->authorize('edit', $model);
        $this->breadcrumbsCurrentSubpage($model);

        return $model;
    }

    public function indexBefore()
    {
        $model = $this->newModel();

        $this->authorize('list', $model);

        view()->share(compact('model'));
    }

    public function show($id)
    {
        $model = $this->showGeneric($id);

        return view($this->getView(), compact('model'));
    }

    public function showGeneric($id)
    {
        $model = $this->getModel($id);

        $this->authorize('show', $model);
        $this->breadcrumbsShow($model);

        view()->share(['meta_title' => $model->breadcrumb()]);

        return $model;
    }

    public function store()
    {
        $this->storeGeneric();

        $model = $this->storeModel();

        return $this->redirectAfterStore($model);
    }

    public function storeGeneric()
    {
        $this->validate($this->request, $this->rules());
        $this->authorize('create', $this->newModel());
    }

    public function update($id)
    {
        $model = $this->updateGeneric($id);

        $this->updateModel($model);

        return $this->redirectAfterUpdate($model);
    }

    public function updateGeneric($id)
    {
        $model = $this->getModel($id);

        $this->authorize('edit', $model);
        $this->validate($this->request, $this->rules($model));

        return $model;
    }

    protected function appendViewSharedVars()
    {
        parent::appendViewSharedVars();

        view()->share([
            'show_with_count' => $this->show_with_count,
        ]);
    }

    protected function destroyModel($model)
    {
        $model->delete();
    }

    protected function getModel($id)
    {
        $model = $this->newModel();
        $model = $model->where($model->getRouteKeyName(), '=', $id);

        if ($this->method === 'show' && !is_null($this->show_with_count)) {
            $model = $model->withCount($this->show_with_count);
        }

        return $model->firstOrFail();
    }

    protected function getModelName()
    {
        return str_singular(str_replace('Acp\\', 'App\\', $this->class));
    }

    protected function getView()
    {
        return view()->exists($this->view) ? $this->view : "acp.{$this->method}";
    }

    protected function newModel()
    {
        $model = $this->getModelName();

        return new $model;
    }

    protected function populateBreadcrumbs(...$parameters)
    {
    }

    protected function rules($model = null)
    {
        return [];
    }

    protected function storeModel()
    {
        $model = $this->newModel()->fill($this->request->all());
        $model->save();

        return $model;
    }

    protected function updateModel($model)
    {
        $model->update($this->request->all());
    }
}
