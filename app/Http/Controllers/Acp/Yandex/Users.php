<?php namespace App\Http\Controllers\Acp\Yandex;

use App\Domain;
use App\Http\Controllers\Acp\Controller;
use App\Http\Requests\Acp\YandexUserCreate as ModelCreate;
use App\Http\Requests\Acp\YandexUserEdit as ModelEdit;
use App\YandexUser as Model;
use Breadcrumbs;

class Users extends Controller
{
    const URL_PREFIX = 'acp/yandex/users';

    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::push(trans("{$this->prefix}.index"), self::URL_PREFIX);
    }

    public function index()
    {
        $models = Model::orderBy('account')->get();

        return view($this->view, compact('models'));
    }

    public function create()
    {
        Breadcrumbs::push(trans($this->view));

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
        Breadcrumbs::push($model->account, self::URL_PREFIX . "/{$model->id}");
        Breadcrumbs::push(trans($this->view));

        $domains = Domain::yandexReady($model->id)->get();

        return view($this->view, compact('domains', 'model'));
    }

    public function show(Model $model)
    {
        Breadcrumbs::push($model->account);

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
