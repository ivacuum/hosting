<?php

namespace App\Http\Controllers\Acp;

use Breadcrumbs;
use App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::push(trans('menu.acp'), 'acp');
    }
}
