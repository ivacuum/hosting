<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class MyPasswordUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \App\User $user */
        $user = $this->user();
        $hasPassword = !empty($user->password);

        return [
            'password' => $hasPassword ? 'required' : '',
            'new_password' => 'required|string|min:8',
        ];
    }
}
