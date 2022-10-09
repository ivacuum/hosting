<?php namespace App\Http\Controllers;

use App\Spatial\Polygon;
use Illuminate\Http\Request;

class DevMapPolygonController
{
    public function __invoke(Request $request)
    {
        $wkt = $request->input('wkt');

        try {
            $polygon = Polygon::fromWkt($wkt);
        } catch (\Throwable) {
            $polygon = null;
        }

        return view('dev.map-polygon', [
            'wkt' => $wkt,
            'polygon' => $polygon,
        ]);
    }
}
