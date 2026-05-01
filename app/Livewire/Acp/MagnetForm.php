<?php

namespace App\Livewire\Acp;

use App\Domain\Magnet\MagnetCategory;
use App\Domain\Magnet\MagnetStatus;
use App\Domain\Magnet\Models\Magnet;
use App\Livewire\WithGoto;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Authorize;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MagnetForm extends Component
{
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
            $this->magnet = Magnet::query()->findOrFail($this->id);

            $this->rtoId = $this->magnet->rto_id;
            $this->status = $this->magnet->status;
            $this->categoryId = $this->magnet->category_id;
            $this->relatedQuery = $this->magnet->related_query;
        }
    }

    #[Authorize('update', 'magnet')]
    public function submit()
    {
        $this->validate();
        $this->store();

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

    private function store()
    {
        $this->magnet->rto_id = $this->rtoId;
        $this->magnet->status = $this->status;
        $this->magnet->category_id = $this->categoryId;
        $this->magnet->related_query = $this->relatedQuery;
        $this->magnet->save();
    }
}
