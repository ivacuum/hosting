<?php namespace App\Http\Livewire;

use App\Domain;
use App\Services\YandexPdd\DnsRecordType;
use App\Services\YandexPdd\YandexPddClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DnsRecordForm extends Component
{
    use AuthorizesRequests;

    public int $ttl = 3600;
    public ?int $port = null;
    public ?int $weight = null;
    public ?int $priority = null;
    public ?int $recordId = null;
    public Domain $domain;
    public string $content = '';
    public string $subdomain = '@';
    public DnsRecordType|string $type = DnsRecordType::A;

    public function rules()
    {
        return [
            'ttl' => 'integer|min:900|max:21600',
            'port' => 'nullable|integer|min:1|max:65535',
            'weight' => 'nullable|integer|min:0|max:100',
            'content' => 'required',
            'priority' => 'nullable|integer|min:0|max:100',
            'subdomain' => 'required',
        ];
    }

    public function submit(YandexPddClient $yandexPdd)
    {
        $this->authorize('create', Domain::class);
        $this->validate();

        if ($this->recordId) {
            $this->update($yandexPdd);
        } else {
            $this->store($yandexPdd);
        }

        return redirect()->to("/acp/domains/{$this->domain->domain}/ns-records");
    }

    private function store(YandexPddClient $yandexPdd)
    {
        $type = $this->typeAsEnum();

        match ($type) {
            DnsRecordType::A,
            DnsRecordType::AAAA,
            DnsRecordType::CNAME,
            DnsRecordType::TXT => $yandexPdd->addDnsRecord(
                $this->domain->yandexUser->token,
                $this->domain->domain,
                $type,
                $this->subdomain,
                $this->content,
            ),
            DnsRecordType::MX => $yandexPdd->addMxDnsRecord(
                $this->domain->yandexUser->token,
                $this->domain->domain,
                $this->subdomain,
                $this->content,
                $this->priority,
            ),
            DnsRecordType::SRV => $yandexPdd->addSrvDnsRecord(
                $this->domain->yandexUser->token,
                $this->domain->domain,
                $this->subdomain,
                $this->content,
                $this->priority,
                $this->port,
                $this->weight,
            ),
        };
    }

    private function update(YandexPddClient $yandexPdd)
    {
        $type = $this->typeAsEnum();

        match ($type) {
            DnsRecordType::A,
            DnsRecordType::AAAA,
            DnsRecordType::CNAME,
            DnsRecordType::TXT => $yandexPdd->editDnsRecord(
                $this->domain->yandexUser->token,
                $this->domain->domain,
                $this->recordId,
                $type,
                $this->subdomain,
                $this->content,
            ),
            DnsRecordType::MX => $yandexPdd->editMxDnsRecord(
                $this->domain->yandexUser->token,
                $this->domain->domain,
                $this->recordId,
                $this->subdomain,
                $this->content,
                $this->priority,
            ),
            DnsRecordType::SRV => $yandexPdd->editSrvDnsRecord(
                $this->domain->yandexUser->token,
                $this->domain->domain,
                $this->recordId,
                $this->subdomain,
                $this->content,
                $this->priority,
                $this->port,
                $this->weight,
            ),
        };
    }

    private function typeAsEnum(): DnsRecordType
    {
        if ($this->type instanceof DnsRecordType) {
            return $this->type;
        }

        return DnsRecordType::from($this->type);
    }
}
