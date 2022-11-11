<?php namespace Tests\Feature;

use App\Domain;
use App\Domain\DomainMonitoring;
use App\Factory\DomainFactory;
use App\Http\Livewire\Acp\DomainForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpDomainsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/domains/create')
            ->assertOk()
            ->assertSeeLivewire(DomainForm::class);
    }

    public function testEdit()
    {
        $domain = DomainFactory::new()->create();

        $this->get("acp/domains/{$domain->domain}/edit")
            ->assertOk()
            ->assertSeeLivewire(DomainForm::class);
    }

    public function testIndex()
    {
        DomainFactory::new()->create();

        $this->get('acp/domains')
            ->assertOk();
    }

    public function testShow()
    {
        $domain = DomainFactory::new()->create();

        $this->get("acp/domains/{$domain->domain}")
            ->assertOk();
    }

    public function testStore()
    {
        $domain = DomainFactory::new()->make();

        \Livewire::test(DomainForm::class, ['domain' => new Domain])
            ->set('domain.domain', $domain->domain)
            ->set('domain.status', DomainMonitoring::Yes)
            ->set('domain.client_id', $domain->client_id)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/domains');

        $this->get('acp/domains')
            ->assertSee($domain->domain);
    }

    public function testUpdate()
    {
        $domain = DomainFactory::new()->create();

        \Livewire::test(DomainForm::class, ['domain' => $domain])
            ->set('domain.status', DomainMonitoring::No)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/domains');

        $domain->refresh();

        $this->assertSame(DomainMonitoring::No, $domain->status);
    }
}
