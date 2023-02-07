<?php namespace App\Http\Requests;

use App\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MyPasswordUpdateForm extends FormRequest
{
    public User $user;
    public readonly string $newPassword;
    public readonly string|null $currentPassword;

    public function isPasswordInvalid(Hasher $hash): bool
    {
        return !$hash->check($this->currentPassword, $this->user->password);
    }

    public function rules(): array
    {
        return [
            'password' => Rule::when($this->userHasPassword(), 'required'),
            'new_password' => 'required|string|min:8',
        ];
    }

    public function userHasPassword(): bool
    {
        return !empty($this->user->password);
    }

    protected function passedValidation()
    {
        $this->user = $this->user();
        $this->newPassword = $this->input('new_password');
        $this->currentPassword = $this->input('password');
    }
}
