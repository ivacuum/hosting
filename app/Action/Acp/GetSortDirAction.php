<?php namespace App\Action\Acp;

use Illuminate\Http\Request;

class GetSortDirAction
{
    public function __construct(private Request $request)
    {
    }

    public function execute(string $defaultSortDir): string
    {
        $sortDir = $this->request->input('sd', $defaultSortDir);

        if (!in_array($sortDir, ['asc', 'desc'])) {
            return $defaultSortDir;
        }

        return $sortDir;
    }
}
