<?php namespace App\Http\Livewire\Acp;

use App\Http\Livewire\WithGoto;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public User $user;

    public function rules()
    {
        return [
            'user.email' => [
                'required',
                'email',
                Rule::unique(User::class, 'email')->ignore($this->user),
            ],
            'user.status' => 'boolean',
        ];
    }

    public function submit()
    {
        $this->authorize('update', $this->user);
        $this->validate();
        $this->user->save();

        return redirect()->to($this->goto ?? to('acp/users'));
    }
}
