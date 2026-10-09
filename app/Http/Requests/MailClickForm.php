<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Uri\WhatWg\Url;

class MailClickForm extends FormRequest
{
    public readonly string $goto;
    public readonly bool $isSigned;

    public function rules(): array
    {
        return [
            'goto' => ['sometimes', 'required', 'string'],
        ];
    }

    #[\Override]
    protected function passedValidation(): void
    {
        $this->isSigned = $this->hasValidSignature();
        $this->goto = $this->resolveGoto();
    }

    private function resolveGoto(): string
    {
        $goto = $this->input('goto', '/');

        if ($this->isSigned) {
            return $goto;
        }

        $base = new Url($this->getSchemeAndHttpHost());
        $destination = Url::parse($goto, $base);

        abort_if(
            $destination === null
            || $destination->getScheme() !== $base->getScheme()
            || $destination->getAsciiHost() !== $base->getAsciiHost()
            || $destination->getPort() !== $base->getPort(),
            403,
        );

        return $destination->toAsciiString();
    }
}
