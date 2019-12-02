<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

class Torrent extends Resource
{
    public static $group = 'Resources';
    public static $model = \App\Torrent::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title',
    ];

    public function actions(Request $request)
    {
        return [
            app(Actions\UpdateTorrentFromRtoAction::class),
        ];
    }

    public function cards(Request $request)
    {
        return [
            new Metrics\TorrentClicksMetric,
            new Metrics\TorrentViewsMetric,
        ];
    }

    public function fields(Request $request)
    {
        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User')->hideFromIndex(),
            Fields\Number::make('RTO ID')->hideFromIndex(),
            Fields\Text::make('Title', function (\App\Torrent $torrent) {
                return $torrent->shortTitle();
            })->rules('max:255')->asHtml(),
            Fields\Select::make('Status')->options([
                \App\Torrent::STATUS_HIDDEN => 'Hidden',
                \App\Torrent::STATUS_PUBLISHED => 'Published',
                \App\Torrent::STATUS_DELETED => 'Deleted',
            ])->displayUsingLabels(),
            Fields\Text::make('Related Query')->hideFromIndex(),
            Fields\Number::make('Clicks')->sortable()->exceptOnForms(),
            Fields\Number::make('Views')->sortable()->exceptOnForms(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Registered At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),

            Fields\MorphMany::make('Comments'),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new Filters\TorrentStatusFilter,
        ];
    }
}
