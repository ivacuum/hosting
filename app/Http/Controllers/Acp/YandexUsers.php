<?php namespace App\Http\Controllers\Acp;

use App\Domain;
use App\YandexUser as Model;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class YandexUsers extends Controller
{
    protected $show_with_count = ['domains'];

    public function index()
    {
        $models = Model::orderBy('account')
            ->paginate()
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('models'));
    }

    public function create()
    {
        $model = $this->createGeneric();

        $domains = Domain::yandexReady()->get();

        return view($this->getView(), compact('domains', 'model'));
    }

    public function edit($id)
    {
        $model = $this->editGeneric($id);

        $domains = Domain::yandexReady($model->id)->get();

        return view($this->getView(), compact('domains', 'model'));
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'token' => 'required',
            'account' => [
                'required',
                Rule::unique('yandex_users', 'account')->ignore($model->id ?? null),
            ],
        ];
    }

    protected function storeModel()
    {
        $model = Model::create($this->requestDataForModel());

        // Newly specified user domains
        foreach (request('domains', []) as $id => $one) {
            $userDomains[] = $id;
        }

        if (!empty($userDomains)) {
            Domain::whereIn('id', $userDomains)
                ->update(['yandex_user_id' => $model->id]);
        }

        return $model;
    }

    /**
     * @param  Model $model
     */
    protected function updateModel($model)
    {
        $token = request('token');

        $model->account = request('account');

        if ($token) {
            $model->token = $token;
        }

        $model->save();

        // Domains w/out yandex user specified
        foreach ($model->domains as $domain) {
            if (!request()->input("domains.{$domain->id}")) {
                $anonDomains[] = $domain->id;
            }
        }

        if (!empty($anonDomains)) {
            Domain::whereIn('id', $anonDomains)
                ->update(['yandex_user_id' => 0]);
        }

        // Newly specified user domains
        foreach (request('domains', []) as $id => $one) {
            $userDomains[] = $id;
        }

        if (!empty($userDomains)) {
            Domain::whereIn('id', $userDomains)
                ->update(['yandex_user_id' => $model->id]);
        }
    }
}
