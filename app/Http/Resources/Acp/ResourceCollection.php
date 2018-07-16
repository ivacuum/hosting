<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\ResourceCollection as BaseResourceCollection;

class ResourceCollection extends BaseResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource->appends(\UrlHelper::except()));
    }
}
