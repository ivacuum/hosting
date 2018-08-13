<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\ResourceCollection as BaseResourceCollection;

class ResourceCollection extends BaseResourceCollection
{
    public function __construct($resource)
    {
        if (method_exists($resource, 'appends')) {
            $resource = $resource->appends(\UrlHelper::except());
        }

        parent::__construct($resource);
    }
}
