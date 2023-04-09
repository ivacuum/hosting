<?php namespace App\Utilities;

use App\Action\Acp\GetSortDirAction;
use App\Domain\Sort;

class UrlHelper
{
    private Sort|null $sort = null;

    public function __construct(private GetSortDirAction $getSortDir)
    {
    }

    public function edit(string $controller, $model): string
    {
        return path(
            [$controller, 'edit'],
            [$model, 'goto' => static::go() . "#{$model->getRouteKeyName()}-{$model->getRouteKey()}"]
        );
    }

    public function except(array $params = []): array
    {
        return \Request::except($params);
    }

    public function filter(array $query = []): string
    {
        return fullUrl(array_merge([
            'page' => null,
        ], $query));
    }

    public function go(array $query = []): string
    {
        return fullUrl($query);
    }

    public function setSort(Sort $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function sort(string $key, string|null $defaultDir = null): string
    {
        if ($this->sort->key !== null && $this->sort->key !== $key) {
            // При смене поля сортировки используется
            // направление сортировки по умолчанию
            $dir = match ($defaultDir ?? $this->sort->direction->value) {
                'asc' => '',
                'desc' => '-',
            };
        } else {
            $dir = match ($this->getSortDir->execute($this->sort->toString())) {
                'asc' => '-',
                'desc' => '',
            };
        }

        return $this->filter([
            'sk' => $dir . $key,
        ]);
    }
}
