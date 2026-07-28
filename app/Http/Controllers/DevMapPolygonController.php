<?php

namespace App\Http\Controllers;

use App\Domain\Spatial\Polygon;
use App\Http\Requests\DevMapPolygonForm;

class DevMapPolygonController
{
    public function __invoke(DevMapPolygonForm $request)
    {
        try {
            $polygon = Polygon::fromWkt($request->wkt);
        } catch (\Throwable) {
            $polygon = null;
        }

        return view('dev.map-polygon', [
            'wkt' => $request->wkt,
            'polygon' => $polygon,
        ]);
    }
}
