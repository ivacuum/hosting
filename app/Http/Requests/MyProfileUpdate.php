<?php namespace App\Http\Requests;

use App\Rules\Email;
use App\Rules\Username;
use Illuminate\Validation\Rule;
use Ivacuum\Generic\Http\FormRequest;

class MyProfileUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \App\User $user */
        $user = $this->user();

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
}
