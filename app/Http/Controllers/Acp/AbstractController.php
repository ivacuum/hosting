<?php namespace App\Http\Controllers\Acp;

use App\Traits\HasLocalizedTitle;
use Ivacuum\Generic\Controllers\Acp\Controller;

abstract class AbstractController extends Controller
{
    protected function getSortDir()
    {
        $sortDir = request('sd', $this->sortDir);

        if (!in_array($sortDir, ['asc', 'desc'])) {
            $sortDir = $this->sortDir;
        }

        return $sortDir;
    }

    protected function getSortKey()
    {
        $sortKey = request('sk', $this->sortKey);

        if (!in_array($sortKey, $this->sortableKeys)) {
            $sortKey = $this->sortKey;
        }

        if (in_array(HasLocalizedTitle::class, class_uses_recursive($this->newModel()))) {
            $sortKey = $sortKey === 'title'
                ? $this->newModel()::titleField()
                : $sortKey;
        }

        return $sortKey;
    }
}
