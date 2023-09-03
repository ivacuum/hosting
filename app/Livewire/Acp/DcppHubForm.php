<?php

namespace App\Livewire\Acp;

use App\DcppHub;
use App\Domain\DcppHubStatus;
use App\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class DcppHubForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    #[Rule(['required', 'integer', 'min:1', 'max:65535'])]
    public int|null $port = 411;

    #[Rule('required')]
    public string|null $title = '';

    #[Rule('required')]
    public string|null $address = '';

    #[Rule('required')]
    public DcppHubStatus|string|null $status = DcppHubStatus::Published;

    public function mount()
    {
        if ($this->id) {
            $dcppHub = DcppHub::findOrFail($this->id);

            $this->port = $dcppHub->port;
            $this->title = $dcppHub->title;
            $this->status = $dcppHub->status;
            $this->address = $dcppHub->address;
        }
    }

    public function submit()
    {
        $this->authorize('create', DcppHub::class);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/dcpp-hubs'));
    }

    private function store()
    {
        $dcppHub = $this->id
            ? DcppHub::findOrFail($this->id)
            : new DcppHub;

        $dcppHub->port = $this->port;
        $dcppHub->title = $this->title;
        $dcppHub->status = $this->status;
        $dcppHub->address = $this->address;
        $dcppHub->save();
    }
}
