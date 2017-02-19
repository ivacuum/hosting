<?php namespace App\Http\Controllers\Acp;

use App\Metric;

class Home extends Controller
{
    public function index()
    {
        $metrics = Metric::today()->get()->pluck('count', 'event');

        foreach (glob(app_path('Events/Stats/*.php')) as $file) {
            $events[] = pathinfo($file, PATHINFO_FILENAME);
        }

        return view('acp.index', compact('events', 'metrics'));
    }
}
