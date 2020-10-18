<?php namespace App\Http\Requests;

use App\ReferrerRedirect;

class LifeIndexRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function from()
    {
        return $this->input('from');
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

    public function shouldRedirectInstagrammer()
    {
        if (!\Str::of($this->header('Referer'))->contains('instagram.com/')) {
            return false;
        }

        return ReferrerRedirect::findFirstActive() !== null;
    }

    public function to()
    {
        return $this->input('to');
    }
}
