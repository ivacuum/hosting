<?php namespace App\Http\Controllers\Acp\Yandex;

use App\Domain;
use App\Http\Controllers\Acp\Controller;
use App\Http\Requests\Acp\YandexUserCreate as ModelCreate;
use App\Http\Requests\Acp\YandexUserEdit as ModelEdit;
use App\YandexUser as Model;

class Users extends Controller
{
    protected $title_attr = 'account';

    public function index()
    {
        $models = Model::orderBy('account')->get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        $this->breadcrumbs();

        $domains = Domain::yandexReady()->get();

        return view($this->view, compact('domains'));
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
        $this->breadcrumbs($model);

        $domains = Domain::yandexReady($model->id)->get();

        return view($this->view, compact('domains', 'model'));
    }

    public function show(Model $model)
    {
        $this->breadcrumbs($model);

        $filter = '';
        $q = $this->request->input('q');

        $domains = $model->domains()->orderBy('paid_till');

        if ($q) {
            $domains = $domains->where('domain', 'LIKE', "%{$q}%");
        }

        $model->domains = $domains->paginate()
            ->appends(compact('q'));

        return view($this->view, compact('filter', 'model', 'q'));
    }

    public function store(ModelCreate $request)
    {
        $model = Model::create($request->all());

        // Newly specified user domains
        foreach ($request->input('domains', []) as $id => $one) {
            $user_domains[] = $id;
        }

        if (!empty($user_domains)) {
            Domain::whereIn('id', $user_domains)
                ->update(['yandex_user_id' => $model->id]);
        }

        return redirect()->action("{$this->class}@index");
    }

    public function update(Model $model, ModelEdit $request)
    {
        $token = $request->input('token');

        $model->account = $request->input('account');

        if ($token) {
            $model->token = $token;
        }

        $model->save();

        // Domains w/out yandex user specified
        foreach ($model->domains as $domain) {
            if (!$request->input("domains.{$domain->id}")) {
                $anon_domains[] = $domain->id;
            }
        }

        if (!empty($anon_domains)) {
            Domain::whereIn('id', $anon_domains)
                ->update(['yandex_user_id' => 0]);
        }

        // Newly specified user domains
        foreach ($request->input('domains', []) as $id => $one) {
            $user_domains[] = $id;
        }

        if (!empty($user_domains)) {
            Domain::whereIn('id', $user_domains)
                ->update(['yandex_user_id' => $model->id]);
        }

        $goto = $request->input('goto', '');

        if ($request->exists('_save')) {
            return $goto
                ? redirect()->action("{$this->class}@edit", [$model, 'goto' => $goto])
                : redirect()->action("{$this->class}@edit", $model);
        }

        return $goto ? redirect($goto) : redirect()->action("{$this->class}@index");
    }
}
