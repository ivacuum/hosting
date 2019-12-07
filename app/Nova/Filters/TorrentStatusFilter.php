<?php namespace App\Nova\Filters;

use App\Torrent;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class TorrentStatusFilter extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $query */
        return $query->where('status', $value);
    }

    public function options(Request $request)
    {
        return [
            'Hidden' => Torrent::STATUS_HIDDEN,
            'Deleted' => Torrent::STATUS_DELETED,
        ];
    }
}
