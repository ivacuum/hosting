<?php namespace App\Http\Requests;

use App\Rules\Email;
use App\Rules\Username;
use App\User;
use Illuminate\Validation\Rule;

class MyProfileUpdateForm extends AbstractForm
{
    public User $user;
    public readonly string $email;
    public readonly string $username;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->userModel();

        return [
            'email' => [
                ...Email::rules(),
                Rule::unique(User::class)->ignore($user),
            ],
            'username' => [
                ...Username::rules(),
                Rule::unique(User::class, 'login')->ignore($user),
            ],
        ];
    }

    protected function passedValidation()
    {
        $this->user = $this->user();
        $this->email = $this->input('email');
        $this->username = $this->input('username', '');
    }
}
