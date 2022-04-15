<?php namespace App\Http\Requests;

use App\Rules\Email;
use App\User;
use Illuminate\Validation\Rule;

class CommentStoreForm extends AbstractForm
{
    public ?User $user;
    public readonly string $text;
    public readonly ?string $email;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => 'required|max:1000',
            'email' => Rule::when($this->isGuest(), Email::rules()),
        ];
    }

    protected function passedValidation()
    {
        $this->text = e($this->input('text'));
        $this->user = $this->user();
        $this->email = $this->input('email');
    }
}
