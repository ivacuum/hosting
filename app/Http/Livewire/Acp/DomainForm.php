<?php namespace App\Http\Livewire\Acp;

use App\Domain;
use App\Http\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DomainForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Domain $domain;

    public function rules()
    {
        return [
            'domain.text' => 'string',
            'domain.domain' => [
                'required',
                'min:3',
                Rule::unique(Domain::class, 'domain')->ignore($this->domain),
            ],
            'domain.orphan' => 'boolean',
            'domain.status' => 'boolean',
            'domain.alias_id' => 'integer',
            'domain.client_id' => 'integer',
            'domain.yandex_user_id' => 'integer',
            'domain.domain_control' => 'boolean',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->domain);
        $this->validate();
        $this->domain->save();

        return redirect()->to($this->goto ?? to('acp/domains'));
    }
}
