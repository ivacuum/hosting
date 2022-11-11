<?php namespace Tests\Feature;

use App\Client;
use App\Factory\ClientFactory;
use App\Http\Livewire\Acp\ClientForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpClientsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/clients/create')
            ->assertOk()
            ->assertSeeLivewire(ClientForm::class);
    }

    public function testEdit()
    {
        $client = ClientFactory::new()->create();

        $this->get("acp/clients/{$client->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(ClientForm::class);
    }

    public function testIndex()
    {
        ClientFactory::new()->create();

        $this->get('acp/clients')
            ->assertOk();
    }

    public function testShow()
    {
        $client = ClientFactory::new()->create();

        $this->get("acp/clients/{$client->id}")
            ->assertOk();
    }

    public function testStore()
    {
        $client = ClientFactory::new()->make();

        \Livewire::test(ClientForm::class, ['client' => new Client])
            ->set('client.name', $client->name)
            ->set('client.email', $client->email)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/clients');

        $this->get('acp/clients')
            ->assertSee($client->name);
    }

    public function testUpdate()
    {
        $client = ClientFactory::new()->create();

        \Livewire::test(ClientForm::class, ['client' => $client])
            ->set('client.name', 'First')
            ->set('client.text', 'Second')
            ->set('client.email', 'client-form@example.com')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/clients');

        $client->refresh();

        $this->assertSame('First', $client->name);
        $this->assertSame('Second', $client->text);
        $this->assertSame('client-form@example.com', $client->email);
    }
}
