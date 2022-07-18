<?php namespace App\Http\Requests;

use App\ReferrerRedirect;
use Illuminate\Foundation\Http\FormRequest;

class LifeIndexForm extends FormRequest
{
    public readonly ?string $to;
    public readonly ?string $from;

    public function authorize(): bool
    {
        return true;
    }

    public function redirectInstagrammer()
    {
        $redirect = ReferrerRedirect::findFirstActive();
        $redirect->clicks++;
        $redirect->save();

        event(new \App\Events\Stats\InstagrammerRedirected);

        return redirect($redirect->to);
    }

    public function rules(): array
    {
        return [
            'to' => 'nullable|date',
            'from' => 'nullable|date',
        ];
    }

    public function shouldRedirectInstagrammer(): bool
    {
        if (!str($this->header('Referer'))->contains('instagram.com/')) {
            return false;
        }

        return ReferrerRedirect::findFirstActive() !== null;
    }

    protected function passedValidation()
    {
        $this->to = $this->input('to');
        $this->from = $this->input('from');
    }
}
