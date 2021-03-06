<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;
use Laravel\Nova\Http\Requests\NovaRequest;

/** @mixin \App\Trip */
class Trip extends Resource
{
    public static $group = 'Life';
    public static $model = \App\Trip::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title_en',
        'title_ru',
    ];
    protected static $defaultOrderBy = ['date_start' => 'desc'];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->withCount('photos')
            ->where('user_id', 1);
    }

    public function actions(Request $request)
    {
        return [
            (new Actions\TripHideAction)->showOnTableRow(),
            (new Actions\TripMakeInactiveAction)->showOnTableRow(),
            (new Actions\TripPublishAction)->showOnTableRow(),
        ];
    }

    public function fields(Request $request)
    {
        return [
            Fields\BelongsTo::make('User')->searchable()->hideFromIndex(),
            Fields\BelongsTo::make('City')->hideFromIndex(),
            Fields\Text::make('Title')->onlyOnIndex(),
            Fields\Text::make('Title RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Title EN')->rules('max:255')->hideFromIndex(),
            Fields\Select::make('Status')->options([
                \App\Trip::STATUS_HIDDEN => 'Hidden',
                \App\Trip::STATUS_INACTIVE => 'Inactive',
                \App\Trip::STATUS_PUBLISHED => 'Published',
            ])->displayUsingLabels()->hideFromIndex(),
            Fields\Text::make('', fn () => view('nova.trip-status', ['trip' => $this])->render())->onlyOnIndex()->textAlign('center')->asHtml(),
            Fields\Text::make('Date', fn () => $this->localizedDate())->asHtml(),
            Fields\Text::make('Slug')->displayUsing(fn () => '<a class="no-underline dim text-primary" href="/life/' . $this->slug . '">' . $this->slug . '</a>')->rules('max:255')->asHtml(),
            Fields\DateTime::make('Date Start')->onlyOnForms(),
            Fields\DateTime::make('Date End')->rules('after_or_equal:date_start')->onlyOnForms(),
            Fields\Text::make('Meta Image')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Description RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Description EN')->rules('max:255')->hideFromIndex(),
            Fields\Number::make('Views')->sortable()->displayUsing(fn () => $this->views ?: '')->exceptOnForms()->textAlign('right'),
            Fields\Number::make('Pic', 'photos_count')->sortable()->displayUsing(fn () => $this->photos_count ?: '')->onlyOnIndex()->textAlign('right'),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
