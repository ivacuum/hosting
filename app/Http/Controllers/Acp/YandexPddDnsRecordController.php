<?php namespace App\Http\Controllers\Acp;

use App\Action\FindYandexPddDnsRecordAction;
use App\Domain;
use App\Services\YandexPdd\YandexPddClient;

class YandexPddDnsRecordController
{
    public function index(Domain $domain, YandexPddClient $yandexPdd)
    {
        return view('acp.domains.ns_records', [
            'model' => $domain,
            'records' => $domain->yandex_user_id
                ? $yandexPdd
                    ->token($domain->yandexUser->token)
                    ->dnsRecords($domain->domain)
                    ->records
                : collect(),
        ]);
    }

    public function destroy(Domain $domain, int $id, YandexPddClient $yandexPdd)
    {
        $yandexPdd
            ->token($domain->yandexUser->token)
            ->deleteDnsRecord($domain->domain, $id);

        return back();
    }

    public function edit(Domain $domain, int $id, FindYandexPddDnsRecordAction $findYandexPddDnsRecord)
    {
        $dnsRecord = $findYandexPddDnsRecord->execute($domain->yandexUser->token, $domain->domain, $id);

        return view('acp.domains.edit-ns-record', [
            'model' => $domain,
            'record' => $dnsRecord,
        ]);
    }
}
