<?php namespace App\Http\Requests;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Rule;

class MyPasswordUpdateForm extends AbstractForm
{
    public function authorize(): bool
    {
        return true;
    }

    public function isPasswordInvalid(Hasher $hash): bool
    {
        return !$hash->check($this->input('password'), $this->userModel()->password);
    }

    public function newPassword()
    {
        return $this->input('new_password');
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
        return !empty($this->userModel()->password);
    }
}
