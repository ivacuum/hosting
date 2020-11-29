<?php namespace App\Http\Requests;

use App\Rules\Email;
use App\Rules\Username;
use Illuminate\Validation\Rule;

class MyProfileUpdateForm extends AbstractForm
{
    public function authorize(): bool
    {
        return true;
    }

    public function email()
    {
        return $this->input('email');
    }

    public function rules(): array
    {
        $user = $this->userModel();

        return [
            'email' => array_merge(
                Email::rules(),
                [Rule::unique('users')->ignore($user->id)]
            ),
            'username' => array_merge(
                Username::rules(),
                [Rule::unique('users', 'login')->ignore($user->id)]
            ),
        ];
    }

    public function username()
    {
        return $this->input('username');
    }
}
