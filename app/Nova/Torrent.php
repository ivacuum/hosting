<?php namespace App\Nova;

use App\Rules\TorrentCategoryId;
use Illuminate\Http\Request;
use Laravel\Nova\Fields;

/** @mixin \App\Torrent */
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
            app(Actions\TorrentRefreshAction::class)->showOnTableRow(),
            app(Actions\TorrentReplaceAction::class)->showOnTableRow(),
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
        $rtoIdRules = [
            'required',
            'unique:torrents,rto_id,{{resourceId}}',
        ];

        return [
            Fields\ID::make()->sortable(),
            Fields\BelongsTo::make('User')->searchable()->hideFromIndex(),
            Fields\Number::make('RTO ID')->rules($rtoIdRules)->hideFromIndex(),
            Fields\Select::make('Category', 'category_id')->options(\TorrentCategoryHelper::novaList())->rules(TorrentCategoryId::rules())->displayUsingLabels()->hideFromIndex(),
            Fields\Text::make('Title', fn () => $this->shortTitle())->rules('max:255')->asHtml(),
            Fields\Select::make('Status')->options([
                \App\Torrent::STATUS_HIDDEN => 'Hidden',
                \App\Torrent::STATUS_PUBLISHED => 'Published',
                \App\Torrent::STATUS_DELETED => 'Deleted',
            ])->displayUsingLabels(),
            Fields\Text::make('Related Query')->hideFromIndex(),
            Fields\Number::make('Clicks')->displayUsing(fn () => $this->clicks ?: '')->sortable()->exceptOnForms(),
            Fields\Number::make('Views')->displayUsing(fn () => $this->views ?: '')->sortable()->exceptOnForms(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Registered At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
            Fields\Text::make('External Link', fn () => '<a class="no-underline dim text-primary" href="' . $this->externalLink() . '" rel="noreferrer">' . $this->externalLink() . '</a>')->onlyOnDetail()->asHtml(),

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
