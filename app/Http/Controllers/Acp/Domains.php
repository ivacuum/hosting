<?php namespace App\Http\Controllers\Acp;

use App\Domain as Model;
use App\Http\Requests\Acp\DomainCreate as ModelCreate;
use App\Http\Requests\Acp\DomainEdit as ModelEdit;
use App\Mail\DomainMailboxes;
use Mail;

class Domains extends Controller
{
    const DEFAULT_ORDER_BY = 'domain';

    protected $title_attr = 'domain';

    public function index()
    {
        abort_unless($this->request->user()->isRoot() === 1, 404);

        $filter = $this->request->input('filter');
        $sort   = $this->request->input('sort');
        $q      = $this->request->input('q');

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

        $models = $models->orderBy($sort)
            ->paginate()
            ->appends(compact('sort', 'filter', 'q'));

        $back_url = $this->request->fullUrl();

        return view($this->view, compact('back_url', 'filter', 'models', 'sort', 'q'));
    }

    public function addMailbox(Model $model)
    {
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

        return redirect()->action("{$this->class}@mailboxes", $model)
            ->with('message', "Данные высланы на почту {$send_to}");
    }

    public function addNsRecord(Model $model)
    {
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

        return ['redirect' => action("{$this->class}@index", $params)];
    }

    public function create()
    {
        return view('acp.create');
    }

    public function deleteNsRecord(Model $model)
    {
        $id = $this->request->input('record_id');

        return $model->deleteNsRecord($id);
    }

    public function destroy(Model $model)
    {
        $model->delete();

        return [
            'status'   => 'OK',
            'redirect' => action("{$this->class}@index"),
        ];
    }

    public function dkimSecretKey(Model $model)
    {
        return nl2br($model->dkimSecretKey()->dkim->secretkey);
    }

    public function edit(Model $model)
    {
        return view('acp.edit', compact('model'));
    }

    public function editNsRecord(Model $model)
    {
        return $model->editNsRecord(
            $this->request->input('record_id'),
            $this->request->input('type'),
            $this->request->only('content', 'subdomain', 'priority', 'port', 'weight', 'retry', 'refresh', 'expire', 'ttl')
        );
    }

    public function mailboxes(Model $model)
    {
        $mailboxes = $model->getMailboxes();

        return view($this->view, compact('mailboxes', 'model'));
    }

    public function nsRecords(Model $model)
    {
        $records = $model->yandex_user_id ? $model->getNsRecords() : [];

        return view($this->view, compact('model', 'records'));
    }

    public function nsServers(Model $model)
    {
        dd($model->getNsServers());
    }

    public function robots(Model $model)
    {
        $robots = $model->getRobotsTxt();

        return view($this->view, compact('model', 'robots'));
    }

    public function setServerNsRecords(Model $model)
    {
        $server = $this->request->input('server');

        $model->setServerNsRecords($server);

        return redirect()->action("{$this->class}@nsRecords", $model);
    }

    public function setYandexNs(Model $model)
    {
        $status = $model->setYandexNs();

        $message = 'success' == $status
            ? 'Днс Яндекса установлены'
            : 'Не удалось установить днс Яндекса';

        return redirect()->action("{$this->class}@show", $model)
            ->with('message', $message);
    }

    public function show(Model $model)
    {
        abort_unless($this->request->user()->id === 1, 404);

        return view($this->view, compact('model'));
    }

    public function store(ModelCreate $request)
    {
        $model = Model::create($request->all());

        return redirect()->action("{$this->class}@show", $model);
    }

    public function update(Model $model, ModelEdit $request)
    {
        $input = $request->all();

        /* Сохранение ранее указанных паролей */
        $passwords = $request->only('cms_pass', 'ftp_pass', 'ssh_pass', 'db_pass');

        foreach ($passwords as $key => $value) {
            if (!$value) {
                unset($input[$key]);
            }
        }

        $model->update($input);

        return $this->redirectAfterUpdate($model);
    }

    public function whois(Model $model)
    {
        $model->updateWhois();

        $whois = nl2br(trim($model->getWhoisData()));

        return view($this->view, compact('model', 'whois'));
    }

    public function yandexPddStatus(Model $model)
    {
        dd($model->getPddStatus());
    }

    protected function breadcrumbsMailboxes(Model $model)
    {
        $this->breadcrumbsEdit($model);
    }

    protected function breadcrumbsNsRecords(Model $model)
    {
        $this->breadcrumbsEdit($model);
    }

    protected function breadcrumbsRobots(Model $model)
    {
        $this->breadcrumbsEdit($model);
    }

    protected function breadcrumbsWhois(Model $model)
    {
        $this->breadcrumbsEdit($model);
    }
}
