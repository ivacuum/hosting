<?php

namespace App\Http\Livewire\Acp;

use App\DcppHub;
use App\Http\Livewire\WithGoto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DcppHubForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public DcppHub $dcppHub;

    public function rules()
    {
        return [
            'dcppHub.port' => 'required|integer|min:1|max:65535',
            'dcppHub.title' => 'required',
            'dcppHub.status' => 'required',
            'dcppHub.address' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->dcppHub);
        $this->validate();
        $this->dcppHub->save();

        return redirect()->to($this->goto ?? to('acp/dcpp-hubs'));
    }
}
