<?php

namespace App\Livewire\Acp;

use App\Domain\MagnetCategory;
use App\Domain\MagnetStatus;
use App\Livewire\WithGoto;
use App\Magnet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MagnetForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public Magnet $magnet;

    #[Locked]
    public int $id;

    public int|null $rtoId = null;

    #[Validate('string')]
    public string|null $relatedQuery = '';

    #[Validate('required')]
    public MagnetStatus $status = MagnetStatus::Published;

    #[Validate('required')]
    public MagnetCategory|int|null $categoryId = null;

    public function mount()
    {
        if ($this->id) {
            $magnet = Magnet::query()->findOrFail($this->id);

            $this->rtoId = $magnet->rto_id;
            $this->status = $magnet->status;
            $this->categoryId = $magnet->category_id;
            $this->relatedQuery = $magnet->related_query;
        }
    }

    public function submit()
    {
        $magnet = Magnet::query()->findOrFail($this->id);

        $this->authorize('update', $magnet);
        $this->validate();
        $this->store($magnet);

        return redirect()->to($this->goto ?? to('acp/magnets'));
    }

    protected function rules()
    {
        return [
            'rtoId' => [
                'required',
                Rule::unique(Magnet::class, 'rto_id')
                    ->ignore(Magnet::query()->find($this->id)),
            ],
        ];
    }

    private function store(Magnet $magnet)
    {
        $magnet->rto_id = $this->rtoId;
        $magnet->status = $this->status;
        $magnet->category_id = $this->categoryId;
        $magnet->related_query = $this->relatedQuery;
        $magnet->save();
    }
}
