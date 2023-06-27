<?php

namespace App\Action\Acp;

use Illuminate\Http\Request;

class GetSortDirAction
{
    public function __construct(private Request $request)
    {
    }

    public function execute(string $defaultSort): string
    {
        $sort = $this->request->input('sk', $defaultSort);

        if (str_starts_with($sort, '-')) {
            return 'desc';
        }

        return 'asc';
    }
}
