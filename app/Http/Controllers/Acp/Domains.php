<?php namespace App\Http\Controllers\Acp;

use App\Action\Acp\ApplyIndexGoodsAction;
use App\Action\Acp\ResponseToCreateAction;
use App\Action\Acp\ResponseToDestroyAction;
use App\Action\Acp\ResponseToEditAction;
use App\Action\Acp\ResponseToShowAction;
use App\Action\FetchRobotsTxtAction;
use App\Action\GetRawWhoisDataAction;
use App\Action\GetWhoisDataAction;
use App\Domain;
use App\Domain\DomainMonitoring;
use App\Events\DomainWhoisUpdated;
use App\Mail\DomainMailboxesMail;
use App\Rules\Email;
use App\Services\YandexPdd\YandexPddClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class Domains extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Domain::class);
    }

    public function index(ApplyIndexGoodsAction $applyIndexGoods)
    {
        $sort = $applyIndexGoods->execute(new Domain, Domain\Sort::asc('domain'));

        $q = request('q');
        $filter = request('filter');
        $clientId = request('client_id');
        $yandexUserId = request('yandex_user_id');

        $models = match ($filter) {
            'external' => Domain::where('status', 1)
                ->whereDomainControl(0),
            'inactive' => Domain::where('status', DomainMonitoring::No),
            'no-ns' => Domain::where('status', 1)
                ->whereNs(''),
            'no-server' => Domain::where('status', 1)
                ->whereIpv4(''),
            'orphan' => Domain::where('orphan', 1),
            'trashed' => Domain::onlyTrashed(),
            default => Domain::where('status', 1),
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

        $models = $models
            ->orderBy(match ($sort->key) {
                'registered_at',
                'paid_till' => $sort->key,
                default => 'domain',
            }, $sort->direction->value)
            ->paginate();

        return view('acp.domains.index', [
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

            $yandexPdd
                ->token($domain->yandexUser->token)
                ->emailAdd($domain->domain, $login, $password);

            $mailboxes[] = [
                'user' => $login,
                'pass' => $password,
            ];
        }

        \Mail::to($sendTo)->send(new DomainMailboxesMail($domain, $mailboxes));

        return redirect(path([self::class, 'mailboxes'], $domain))
            ->with('message', "Данные высланы на почту {$sendTo}");
    }

    public function batch()
    {
        $action = request('action');
        $ids = request('ids');

        $params = [];

        switch ($action) {
            case 'activate':

                Domain::whereIn('id', $ids)->update(['status' => 1]);

                break;
            case 'deactivate':

                Domain::whereIn('id', $ids)->update(['status' => 0]);

                break;
            case 'delete':

                Domain::destroy($ids);

                break;
            case 'force_delete':

                $params['filter'] = 'trashed';

                Domain::whereIn('id', $ids)->onlyTrashed()->forceDelete();

                break;
            case 'restore':

                $params['filter'] = 'trashed';

                Domain::whereIn('id', $ids)->onlyTrashed()->restore();

                break;
        }

        return ['redirect' => path([self::class, 'index'], $params)];
    }

    public function mailboxes(Domain $domain, YandexPddClient $yandexPdd)
    {
        return view('acp.domains.mailboxes', [
            'model' => $domain,
            'mailboxes' => $yandexPdd
                ->token($domain->yandexUser->token)
                ->emails($domain->domain),
        ]);
    }

    public function robots(Domain $domain, FetchRobotsTxtAction $fetchRobotsTxt)
    {
        return view('acp.domains.robots', [
            'model' => $domain,
            'robots' => $fetchRobotsTxt->execute($domain->domain),
        ]);
    }

    public function whois(Domain $domain, GetWhoisDataAction $getWhoisData, GetRawWhoisDataAction $getRawWhoisData)
    {
        if (null !== $data = $getWhoisData->execute($domain->domain)) {
            event(new DomainWhoisUpdated($domain, $data));

            $domain->update($data);
        }

        return view('acp.domains.whois', [
            'model' => $domain,
            'whois' => $getRawWhoisData->execute($domain->domain),
        ]);
    }

    public function create(Domain $domain, ResponseToCreateAction $responseToCreate)
    {
        return $responseToCreate->execute($domain);
    }

    public function destroy(Domain $domain, ResponseToDestroyAction $responseToDestroy)
    {
        return $responseToDestroy->execute($domain);
    }

    public function edit(Domain $domain, ResponseToEditAction $responseToEdit)
    {
        return $responseToEdit->execute($domain);
    }

    public function show(Domain $domain, ResponseToShowAction $responseToShow)
    {
        return $responseToShow->execute($domain);
    }
}
