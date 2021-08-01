<?php namespace App\Nova\Filters;

use App\Domain\TorrentStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class TorrentStatusFilter extends Filter
{
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('status', $value);
    }

    public function options(Request $request)
    {
        return [
            'Hidden' => TorrentStatus::HIDDEN,
            'Deleted' => TorrentStatus::DELETED,
        ];
    }
}
