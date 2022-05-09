<?php namespace App\Action\Acp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApplyIndexGoodsAction
{
    public function __construct(
        private GetSortDirAction $getSortDir,
        private GetSortKeyAction $getSortKey,
        private Request $request
    ) {
    }

    public function execute(
        Model $model,
        array $sortableKeys = ['id'],
        string $defaultSortDir = 'desc',
        string $defaultSortKey = 'id',
    ): array {
        $modelTpl = implode('.', array_map(fn ($ary) => \Str::snake($ary, '-'), explode('\\', str_replace('App\\', '', get_class($model)))));

        $sortDir = $this->getSortDir->execute($defaultSortDir);
        $sortKey = $this->getSortKey->execute($defaultSortKey, $sortableKeys, $model);

        \UrlHelper::setSortKey($sortKey)
            ->setDefaultSortDir($sortDir);

        view()->share([
            'q' => $this->request->input('q'),
            'model' => $model,
            'sortDir' => $sortDir,
            'sortKey' => $sortKey,
            'modelTpl' => $modelTpl,
        ]);

        return [$sortKey, $sortDir];
    }
}
