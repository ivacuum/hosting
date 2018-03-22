<?php namespace App\Http\Controllers\Acp;

use App\Domain as Model;
use App\Mail\DomainMailboxes;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Controllers\Acp\Controller;

class Domains extends Controller
{
    const DEFAULT_ORDER_BY = 'domain';

    public function index()
    {
        $q = request('q');
        $sort = request('sort');
        $filter = request('filter');
        $client_id = request('client_id');
        $yandex_user_id = request('yandex_user_id');

        if (!in_array($sort, ['domain', 'registered_at', 'paid_till'])) {
            $sort = static::DEFAULT_ORDER_BY;
        }

        switch ($filter) {
            case 'external':

                $models = Model::where('status', 1)
                    ->whereDomainControl(0);

            break;
            case 'inactive':

                $models = Model::where('status', 0);

            break;
            case 'no-ns':

                $models = Model::where('status', 1)
                    ->whereNs('');

            break;
            case 'no-server':

                $models = Model::where('status', 1)
                    ->whereIpv4('');

            break;
            case 'orphan':

                $models = Model::whereOrphan(1);

            break;
            case 'trashed':

                $models = Model::onlyTrashed();

            break;
            default:

                $models = Model::where('status', 1);
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
            ->withPath(path("{$this->class}@index"));

        return view($this->view, compact('filter', 'models', 'sort', 'q'));
    }

    public function addMailbox($domain)
    {
        request()->validate([
            'logins' => 'required',
            'send_to' => 'required|email',
        ]);

        $model = $this->getModel($domain);

        $logins = request('logins');
        $send_to = request('send_to');

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

        \Mail::to($send_to)->queue(new DomainMailboxes($model, $mailboxes));

        return redirect(path("{$this->class}@mailboxes", $model))
            ->with('message', "Данные высланы на почту {$send_to}");
    }

    public function addNsRecord($domain)
    {
        $model = $this->getModel($domain);

        return $model->addNsRecord(
            request('type'),
            request(['content', 'subdomain', 'priority', 'port', 'weight'])
        );
    }

    public function batch()
    {
        $action = request('action');
        $ids = request('ids');

        $params = [];

        switch ($action) {
            case 'activate':

                Model::whereIn('id', $ids)->update(['status' => 1]);

            break;
            case 'deactivate':

                Model::whereIn('id', $ids)->update(['status' => 0]);

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

        $id = request('record_id');

        return $model->deleteNsRecord($id);
    }

    public function dkimSecretKey($domain)
    {
        $model = $this->getModel($domain);

        return $model->dkimSecretKey()->dkim->secretkey;
    }

    public function editNsRecord($domain)
    {
        $model = $this->getModel($domain);

        return $model->editNsRecord(
            request('record_id'),
            request('type'),
            request(['content', 'subdomain', 'priority', 'port', 'weight', 'retry', 'refresh', 'expire', 'ttl'])
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

        $server = request('server');

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

        $whois = trim($model->getWhoisData());

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
            'status' => 'boolean',
            'domain_control' => 'boolean',
        ];
    }

    protected function updateModel($model)
    {
        $input = $this->requestDataForModel();

        /* Сохранение ранее указанных паролей */
        $passwords = request(['cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass']);

        foreach ($passwords as $key => $value) {
            if (!$value) {
                unset($input[$key]);
            }
        }

        $model->update($input);
    }
}
