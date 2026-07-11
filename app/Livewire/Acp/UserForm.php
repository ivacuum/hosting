<?php

namespace App\Livewire\Acp;

use App\Domain\UserStatus;
use App\Livewire\WithGoto;
use App\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Authorize;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UserForm extends Component
{
    use WithGoto;

    public User $user;

    #[Locked]
    public int $id;

    public UserStatus $status = UserStatus::Active;
    public string|null $email = '';

    public function mount()
    {
        if ($this->id) {
            $this->user = User::query()->findOrFail($this->id);

            $this->email = $this->user->email;
            $this->status = $this->user->status;
        }
    }

    #[Authorize('update', 'user')]
    public function submit()
    {
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/users'));
    }

    protected function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique(User::class, 'email')
                    ->ignore(User::query()->find($this->id)),
            ],
        ];
    }

    private function store()
    {
        $this->user->email = $this->email;
        $this->user->status = $this->status;
        $this->user->save();
    }
}
