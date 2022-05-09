<?php namespace App\Action\Acp;

use App\Traits\HasLocalizedTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GetSortKeyAction
{
    public function __construct(private Request $request)
    {
    }

    public function execute(string $defaultSortKey, array $sortableKeys, Model $model): string
    {
        $sortKey = $this->request->input('sk', $defaultSortKey);

        if ($sortKey === 'title' && in_array(HasLocalizedTitle::class, class_uses_recursive($model))) {
            return $model::titleField();
        }

        if (!in_array($sortKey, $sortableKeys)) {
            return $defaultSortKey;
        }

        return $sortKey;
    }
}
