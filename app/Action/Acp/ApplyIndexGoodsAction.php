<?php namespace App\Action\Acp;

use App\Domain\Sort;
use App\Domain\SortDirection;
use App\Utilities\UrlHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApplyIndexGoodsAction
{
    public function __construct(
        private GetSortDirAction $getSortDir,
        private GetSortKeyAction $getSortKey,
        private Request $request,
        private UrlHelper $urlHelper,
    ) {
    }

    public function execute(
        Model $model,
        Sort $defaultSort = new Sort('id', SortDirection::Desc),
    ): Sort {
        $modelTpl = str($model::class)
            ->replace('App\\', '')
            ->explode('\\')
            ->map(fn ($string) => \Str::snake($string, '-'))
            ->implode('.');

        $sortDir = $this->getSortDir->execute($defaultSort->toString());
        $sortKey = $this->getSortKey->execute($defaultSort->toString());

        $sort = new Sort($sortKey, SortDirection::from($sortDir));

        $this->urlHelper->setSort($sort);

        view()->share([
            'q' => $this->request->input('q'),
            'model' => $model,
            'sortDir' => $sort->direction->value,
            'sortKey' => $sort->key,
            'modelTpl' => $modelTpl,
        ]);

        return $sort;
    }
}
