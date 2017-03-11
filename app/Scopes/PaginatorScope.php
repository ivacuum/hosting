<?php namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginatorScope implements Scope
{
    protected $extensions = ['Paginator'];

    public function apply(Builder $builder, Model $model)
    {
    }

    public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    protected function addPaginator(Builder $builder)
    {
        $builder->macro('paginator', function (Builder $builder, $total, $per_page = null, $columns = ['*'], $page_name = 'page', $page = null) {
            $page = $page ?: Paginator::resolveCurrentPage($page_name);
            $per_page = $per_page ?: $builder->getModel()->getPerPage();

            $results = $total
                ? $builder->forPage($page, $per_page)->get($columns)
                : $builder->getModel()->newCollection();

            return new LengthAwarePaginator($results, $total, $per_page, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $page_name,
            ]);
        });
    }
}
