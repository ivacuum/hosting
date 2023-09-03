<?php

namespace App\Livewire\Acp;

use App\Domain\UserStatus;
use App\Livewire\WithGoto;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class UserForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public User $user;

    #[Locked]
    public int $id;

    #[\Livewire\Attributes\Rule('integer')]
    public int|null $status = UserStatus::Active->value;
    public string|null $email = '';

    public function mount()
    {
        if ($this->id) {
            $user = User::findOrFail($this->id);

            $this->email = $user->email;
            $this->status = $user->status;
        }
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique(User::class, 'email')
                    ->ignore(User::find($this->id)),
            ],
        ];
    }

    public function submit()
    {
        $user = User::findOrFail($this->id);

        $this->authorize('update', $user);
        $this->validate();
        $this->store($user);

        return redirect()->to($this->goto ?? to('acp/users'));
    }

    private function store(User $user)
    {
        $user->email = $this->email;
        $user->status = $this->status;
        $user->save();
    }
}
