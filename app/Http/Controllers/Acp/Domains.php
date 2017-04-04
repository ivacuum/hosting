<?php namespace App\Http\Controllers\Acp;

use App\Domain as Model;
use App\Mail\DomainMailboxes;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;
use Mail;

class Domains extends Controller
{
    const DEFAULT_ORDER_BY = 'domain';

    public function index()
    {
        $q = $this->request->input('q');
        $sort = $this->request->input('sort');
        $filter = $this->request->input('filter');
        $client_id = $this->request->input('client_id');
        $yandex_user_id = $this->request->input('yandex_user_id');

        if (!in_array($sort, ['domain', 'registered_at', 'paid_till'])) {
            $sort = self::DEFAULT_ORDER_BY;
        }

        switch ($filter) {
            case 'external':

                $models = Model::whereActive(1)
                    ->whereDomainControl(0);

            break;
            case 'inactive':

                $models = Model::whereActive(0);

            break;
            case 'no-ns':

                $models = Model::whereActive(1)
                    ->whereNs('');

            break;
            case 'no-server':

                $models = Model::whereActive(1)
                    ->whereIpv4('');

            break;
            case 'orphan':

                $models = Model::whereOrphan(1);

            break;
            case 'trashed':

                $models = Model::onlyTrashed();

            break;
            default:

                $models = Model::whereActive(1);
        }

        if ($q) {
            $models = $models->where('domain', 'LIKE', "%{$q}%");
        }
        if ($client_id) {
            $models = $models->where('client_id', $client_id);
        }
        if ($yandex_user_id) {
            $models = $models->where('yandex_user_id', $yandex_user_id);
        }

        $models = $models->orderBy($sort)
            ->paginate()
            ->appends(compact('sort', 'filter', 'q', 'yandex_user_id'));

        return view($this->view, compact('filter', 'models', 'sort', 'q'));
    }

    public function addMailbox($domain)
    {
        $model = $this->getModel($domain);

        $logins = $this->request->input('logins');
        $send_to = $this->request->input('send_to');

        $logins = explode(',', $logins);
        $mailboxes = [];

        foreach ($logins as $login) {
            $password = str_random(16);

            if ('ok' === $model->addMailbox($login, $password)) {
                $mailboxes[] = [
                    'user' => $login,
                    'pass' => $password,
                ];
            }
        }

        Mail::to($send_to)->send(new DomainMailboxes($model, $mailboxes));

        return redirect(path("{$this->class}@mailboxes", $model))
            ->with('message', "Данные высланы на почту {$send_to}");
    }

    public function addNsRecord($domain)
    {
        $model = $this->getModel($domain);

        return $model->addNsRecord(
            $this->request->input('type'),
            $this->request->only('content', 'subdomain', 'priority', 'port', 'weight')
        );
    }

    public function batch()
    {
        $action = $this->request->input('action');
        $ids = $this->request->input('ids');

        $params = [];

        switch ($action) {
            case 'activate':

                Model::whereIn('id', $ids)->update(['active' => 1]);

            break;
            case 'deactivate':

                Model::whereIn('id', $ids)->update(['active' => 0]);

            break;
            case 'delete':

                Model::destroy($ids);

            break;
            case 'force_delete':

                $params['filter'] = 'trashed';

                Model::whereIn('id', $ids)->onlyTrashed()->forceDelete();

            break;
            case 'restore':

                $params['filter'] = 'trashed';

                Model::whereIn('id', $ids)->onlyTrashed()->restore();

            break;
        }

        return ['redirect' => path("{$this->class}@index", $params)];
    }

    public function deleteNsRecord($domain)
    {
        $model = $this->getModel($domain);

        $id = $this->request->input('record_id');

        return $model->deleteNsRecord($id);
    }

    public function dkimSecretKey($domain)
    {
        $model = $this->getModel($domain);

        return nl2br($model->dkimSecretKey()->dkim->secretkey);
    }

    public function editNsRecord($domain)
    {
        $model = $this->getModel($domain);

        return $model->editNsRecord(
            $this->request->input('record_id'),
            $this->request->input('type'),
            $this->request->only('content', 'subdomain', 'priority', 'port', 'weight', 'retry', 'refresh', 'expire', 'ttl')
        );
    }

    public function mailboxes($domain)
    {
        $model = $this->getModel($domain);

        $this->breadcrumbsModelSubpage($model);

        $mailboxes = $model->getMailboxes();

        return view($this->view, compact('mailboxes', 'model'));
    }

    public function nsRecords($domain)
    {
        $model = $this->getModel($domain);

        $this->breadcrumbsModelSubpage($model);

        $records = $model->yandex_user_id ? $model->getNsRecords() : [];

        return view($this->view, compact('model', 'records'));
    }

    public function nsServers($domain)
    {
        $model = $this->getModel($domain);

        dd($model->getNsServers());
    }

    public function robots($domain)
    {
        $model = $this->getModel($domain);

        $this->breadcrumbsModelSubpage($model);

        $robots = $model->getRobotsTxt();

        return view($this->view, compact('model', 'robots'));
    }

    public function setServerNsRecords($domain)
    {
        $model = $this->getModel($domain);

        $server = $this->request->input('server');

        $model->setServerNsRecords($server);

        return redirect(path("{$this->class}@nsRecords", $model));
    }

    public function setYandexNs($domain)
    {
        $model = $this->getModel($domain);

        $status = $model->setYandexNs();

        $message = 'success' == $status
            ? 'Днс Яндекса установлены'
            : 'Не удалось установить днс Яндекса';

        return redirect(path("{$this->class}@show", $model))
            ->with('message', $message);
    }

    public function whois($domain)
    {
        $model = $this->getModel($domain);

        $this->breadcrumbsModelSubpage($model);

        $model->updateWhois();

        $whois = nl2br(trim($model->getWhoisData()));

        return view($this->view, compact('model', 'whois'));
    }

    public function yandexPddStatus($domain)
    {
        $model = $this->getModel($domain);

        dd($model->getPddStatus());
    }

    /**
     * Служебный метод для автодополнения кода
     *
     * @param  string  $domain
     * @return Model
     */
    protected function getModel($domain)
    {
        return parent::getModel($domain);
    }

    /**
     * @param  Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'domain' => [
                'required',
                'min:3',
                Rule::unique('domains', 'domain')->ignore($model->id ?? null),
            ],
            'active' => 'boolean',
            'domain_control' => 'boolean',
        ];
    }

    protected function updateModel($model)
    {
        $input = $this->request->all();

        /* Сохранение ранее указанных паролей */
        $passwords = $this->request->only('cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass');

        foreach ($passwords as $key => $value) {
            if (!$value) {
                unset($input[$key]);
            }
        }

        $model->update($input);
    }
}
