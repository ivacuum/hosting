<?php

namespace App\Http\Livewire\Acp;

use App\Http\Livewire\WithGoto;
use App\Magnet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class MagnetForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Magnet $magnet;

    public function rules()
    {
        return [
            'magnet.rto_id' => [
                'required',
                Rule::unique(Magnet::class, 'rto_id')->ignore($this->magnet),
            ],
            'magnet.status' => 'required',
            'magnet.category_id' => 'required|integer|min:1',
            'magnet.related_query' => 'string',
        ];
    }

    public function submit()
    {
        $this->authorize('update', $this->magnet);
        $this->validate();
        $this->magnet->save();

        return redirect()->to($this->goto ?? to('acp/magnets'));
    }
}
