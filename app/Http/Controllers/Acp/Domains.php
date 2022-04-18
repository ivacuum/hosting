<?php namespace App\Http\Controllers\Acp;

use App\Domain;
use App\Domain as Model;
use App\Mail\DomainMailboxesMail;
use App\Rules\Email;
use App\Services\YandexPdd\YandexPddClient;
use Illuminate\Validation\Rule;

class Domains extends AbstractController
{
    const DEFAULT_ORDER_BY = 'domain';

    public function index()
    {
        $q = request('q');
        $sort = request('sort');
        $filter = request('filter');
        $clientId = request('client_id');
        $yandexUserId = request('yandex_user_id');

        if (!in_array($sort, ['domain', 'registered_at', 'paid_till'])) {
            $sort = static::DEFAULT_ORDER_BY;
        }

        $models = match ($filter) {
            'external' => Model::where('status', 1)
                ->whereDomainControl(0),
            'inactive' => Model::where('status', 0),
            'no-ns' => Model::where('status', 1)
                ->whereNs(''),
            'no-server' => Model::where('status', 1)
                ->whereIpv4(''),
            'orphan' => Model::whereOrphan(1),
            'trashed' => Model::onlyTrashed(),
            default => Model::where('status', 1),
        };

        if ($q) {
            $models = $models->where('domain', 'LIKE', "%{$q}%");
        }
        if ($clientId) {
            $models = $models->where('client_id', $clientId);
        }
        if ($yandexUserId) {
            $models = $models->where('yandex_user_id', $yandexUserId);
        }

        $models = $models->orderBy($sort)
            ->paginate();

        return view($this->view, [
            'q' => $q,
            'sort' => $sort,
            'filter' => $filter,
            'models' => $models,
        ]);
    }

    public function addMailbox(Model $domain, YandexPddClient $yandexPdd)
    {
        request()->validate([
            'logins' => 'required',
            'send_to' => Email::rules(),
        ]);

        $logins = request('logins');
        $sendTo = request('send_to');

        $logins = explode(',', $logins);
        $mailboxes = [];

        foreach ($logins as $login) {
            $password = \Str::random(20);

            $yandexPdd->emailAdd($domain->yandexUser->token, $domain->domain, $login, $password);

            $mailboxes[] = [
                'user' => $login,
                'pass' => $password,
            ];
        }

        \Mail::to($sendTo)->send(new DomainMailboxesMail($domain, $mailboxes));

        return redirect(path([self::class, 'mailboxes'], $domain))
            ->with('message', "Данные высланы на почту {$sendTo}");
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

        return ['redirect' => path([self::class, 'index'], $params)];
    }

    public function deleteNsRecord($domain)
    {
        $model = $this->getModel($domain);

        $id = request('record_id');

        return $model->deleteNsRecord($id);
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

    public function mailboxes(Model $domain, YandexPddClient $yandexPdd)
    {
        $this->breadcrumbsModelSubpage($domain);

        return view($this->view, [
            'model' => $domain,
            'mailboxes' => $yandexPdd->emails($domain->yandexUser->token, $domain->domain),
        ]);
    }

    public function nsRecords(Domain $domain, YandexPddClient $yandexPdd)
    {
        $this->breadcrumbsModelSubpage($domain);

        return view($this->view, [
            'model' => $domain,
            'records' => $domain->yandex_user_id
                ? $yandexPdd->dnsRecords($domain->yandexUser->token, $domain->domain)->records
                : collect(),
        ]);
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

        return view($this->view, [
            'model' => $model,
            'robots' => $model->getRobotsTxt(),
        ]);
    }

    public function setServerNsRecords($domain)
    {
        $model = $this->getModel($domain);

        $server = request('server');

        $model->setServerNsRecords($server);

        return redirect(path([self::class, 'nsRecords'], $model));
    }

    public function setYandexNs($domain)
    {
        $model = $this->getModel($domain);

        $status = $model->setYandexNs();

        $message = 'success' == $status
            ? 'Днс Яндекса установлены'
            : 'Не удалось установить днс Яндекса';

        return redirect(path([self::class, 'show'], $model))
            ->with('message', $message);
    }

    public function whois($domain)
    {
        $model = $this->getModel($domain);

        $this->breadcrumbsModelSubpage($model);

        $model->updateWhois();

        return view($this->view, [
            'model' => $model,
            'whois' => trim($model->getWhoisData()),
        ]);
    }

    /**
     * Служебный метод для автодополнения кода
     *
     * @param string $id
     * @return Model
     */
    protected function getModel($id)
    {
        return value(parent::getModel($id));
    }

    /**
     * @param Model|null $model
     * @return array
     */
    protected function rules($model = null)
    {
        return [
            'domain' => [
                'required',
                'min:3',
                Rule::unique('domains', 'domain')->ignore($model),
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
