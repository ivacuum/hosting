<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintIpForm extends FormRequest
{
    public readonly string|null $ip;
    public readonly string|null $countryCode;

    public function rules(): array
    {
        return [];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->ip = $this->ip();
        $this->countryCode = $this->server->get('HTTP_CF_IPCOUNTRY')
            ?? $this->server->get('COUNTRY_ALPHA2');
    }
}
