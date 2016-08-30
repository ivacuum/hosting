<?php namespace App\Http\Controllers\Acp;

use App\Http\Controllers\Controller as BaseController;
use Breadcrumbs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class Controller extends BaseController
{
    /**
     * Префикс ссылок для цепочки навигации
     *
     * @var string
     */
    protected $breadcrumbs_prefix;

    /**
     * Параметр-заголовок для цепочки навигации
     *
     * @var string
     */
    protected $title_attr = 'title';

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs_prefix = str_replace('.', '/', $this->prefix);

        /* Наполнение цепочки навигации существующими переводами */
        array_reduce(explode('.', $this->prefix), function ($url, $part) {
            $url[] = $part;

            $prefix = implode('.', $url);
            $index = "{$prefix}.index";

            if ($index !== $trans = trans($index)) {
                Breadcrumbs::push($trans, implode('/', $url));
            }

            return $url;
        });
    }

    protected function alwaysCallBefore(...$parameters)
    {
        /* Сборка цепочки навигации */
        $method = 'breadcrumbs' . Str::ucfirst($this->method);

        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $parameters);
        }
    }

    protected function breadcrumbsCreate()
    {
        Breadcrumbs::push(trans($this->view));
    }

    protected function breadcrumbsEdit(Model $model)
    {
        Breadcrumbs::push(
            $model->{$this->title_attr},
            "{$this->breadcrumbs_prefix}/{$model->getRouteKey()}"
        );

        Breadcrumbs::push(trans($this->view));
    }

    protected function breadcrumbsShow(Model $model)
    {
        Breadcrumbs::push($model->{$this->title_attr});
    }
}
