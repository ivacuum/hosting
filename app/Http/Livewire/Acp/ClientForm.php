<?php

namespace App\Http\Livewire\Acp;

use App\Client;
use App\Http\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ClientForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Client $client;

    public function rules()
    {
        return [
            'client.name' => [
                'required',
                Rule::unique(Client::class, 'name')->ignore($this->client),
            ],
            'client.text' => 'string',
            'client.email' => 'email',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->client);
        $this->validate();
        $this->client->save();

        return redirect()->to($this->goto ?? to('acp/clients'));
    }
}
