<?php

namespace App\Livewire\Acp;

use App\Domain\Dcpp\DcppHubStatus;
use App\Domain\Dcpp\Models\DcppHub;
use App\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DcppHubForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    #[Validate(['required', 'integer', 'min:1', 'max:65535'])]
    public int|null $port = 411;

    #[Validate('required')]
    public string|null $title = '';

    #[Validate('required')]
    public string|null $address = '';

    #[Validate('required')]
    public DcppHubStatus $status = DcppHubStatus::Published;

    public function mount()
    {
        if ($this->id) {
            $dcppHub = DcppHub::query()->findOrFail($this->id);

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
            ? DcppHub::query()->findOrFail($this->id)
            : new DcppHub;

        $dcppHub->port = $this->port;
        $dcppHub->title = $this->title;
        $dcppHub->status = $this->status;
        $dcppHub->address = $this->address;
        $dcppHub->save();
    }
}
