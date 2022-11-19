<?php namespace App\Action\Acp;

use Illuminate\Http\Request;
use Illuminate\Support\Stringable;

class GetSortKeyAction
{
    public function __construct(private Request $request)
    {
    }

    public function execute(string $defaultSortKey): string
    {
        return $this->request
            ->string('sk', $defaultSortKey)
            ->whenStartsWith('-', fn (Stringable $string) => $string->after('-'))
            ->toString();
    }
}
