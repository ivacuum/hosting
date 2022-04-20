<?php namespace App\Http\Controllers\Acp;

use App\Action\FetchRobotsTxtAction;
use App\Domain;
use App\Domain as Model;
use App\Mail\DomainMailboxesMail;
use App\Rules\Email;
use App\Services\YandexPdd\DnsRecordType;
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

    public function addMailbox(Domain $domain, YandexPddClient $yandexPdd)
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

    public function addNsRecord(Domain $domain, YandexPddClient $yandexPdd)
    {
        $type = DnsRecordType::from(request('type'));

        $response = match ($type) {
            DnsRecordType::A,
            DnsRecordType::AAAA,
            DnsRecordType::CNAME,
            DnsRecordType::TXT => $yandexPdd->addDnsRecord(
                $domain->yandexUser->token,
                $domain->domain,
                $type,
                request('subdomain'),
                request('content'),
            ),
            DnsRecordType::MX => $yandexPdd->addMxDnsRecord(
                $domain->yandexUser->token,
                $domain->domain,
                request('subdomain'),
                request('content'),
                request('priority'),
            ),
            DnsRecordType::SRV => $yandexPdd->addSrvDnsRecord(
                $domain->yandexUser->token,
                $domain->domain,
                request('subdomain'),
                request('content'),
                request('priority'),
                request('port'),
                request('weight'),
            ),
        };

        return $response->successful
            ? 'ok'
            : 'error';
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

    public function deleteNsRecord(Domain $domain, YandexPddClient $yandexPdd)
    {
        return $yandexPdd
            ->deleteDnsRecord($domain->yandexUser->token, $domain->domain, request('record_id'))
            ->successful
            ? 'ok'
            : 'error';
    }

    public function editNsRecord(Domain $domain, YandexPddClient $yandexPdd)
    {
        $type = DnsRecordType::from(request('type'));

        $response = match ($type) {
            DnsRecordType::A,
            DnsRecordType::AAAA,
            DnsRecordType::CNAME,
            DnsRecordType::TXT => $yandexPdd->editDnsRecord(
                $domain->yandexUser->token,
                $domain->domain,
                request('record_id'),
                $type,
                request('subdomain'),
                request('content'),
            ),
            DnsRecordType::MX => $yandexPdd->editMxDnsRecord(
                $domain->yandexUser->token,
                $domain->domain,
                request('record_id'),
                request('subdomain'),
                request('content'),
                request('priority'),
            ),
            DnsRecordType::SRV => $yandexPdd->editSrvDnsRecord(
                $domain->yandexUser->token,
                $domain->domain,
                request('record_id'),
                request('subdomain'),
                request('content'),
                request('priority'),
                request('port'),
                request('weight'),
            ),
        };

        return $response->successful
            ? 'ok'
            : 'error';
    }

    public function mailboxes(Domain $domain, YandexPddClient $yandexPdd)
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

    public function robots(Domain $domain, FetchRobotsTxtAction $fetchRobotsTxt)
    {
        $this->breadcrumbsModelSubpage($domain);

        return view($this->view, [
            'model' => $domain,
            'robots' => $fetchRobotsTxt->execute($domain->domain),
        ]);
    }

    public function whois(Domain $domain)
    {
        $this->breadcrumbsModelSubpage($domain);

        $domain->updateWhois();

        return view($this->view, [
            'model' => $domain,
            'whois' => trim($domain->getWhoisData()),
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
