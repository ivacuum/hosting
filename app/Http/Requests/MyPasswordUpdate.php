<?php namespace App\Http\Requests;

use Ivacuum\Generic\Http\FormRequest;

class MyPasswordUpdate extends FormRequest
{
    public function rules(): array
    {
        /* @var \App\User $user */
        $user = $this->user();
        $has_password = !empty($user->password);

        return [
            'password' => $has_password ? 'required' : '',
            'new_password' => 'required|string|min:6',
        ];
    }
}
