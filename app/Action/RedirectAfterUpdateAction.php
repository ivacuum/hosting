<?php namespace App\Action;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RedirectAfterUpdateAction
{
    public function __construct(private Request $request, private ParseRouteDataAction $parseRouteData)
    {
    }

    public function execute(Model $model, string $method = 'index')
    {
        $goto = $this->request->input('goto', '');
        $controller = $this->parseRouteData->execute()->controller;

        if ($this->request->exists('_save')) {
            return $goto
                ? redirect(path([$controller, 'edit'], [$model, 'goto' => $goto]))
                : redirect(path([$controller, 'edit'], $model));
        }

        return $goto
            ? redirect($goto)
            : redirect(path([$controller, $method]));
    }
}
