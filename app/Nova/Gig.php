<?php namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields;

/** @mixin \App\Gig */
class Gig extends Resource
{
    public static $group = 'Life';
    public static $model = \App\Gig::class;
    public static $title = 'title';
    public static $search = [
        'id',
        'title_en',
        'title_ru',
    ];
    protected static $defaultOrderBy = ['date' => 'desc'];

    public function fields(Request $request)
    {
        return [
            Fields\BelongsTo::make('Artist')->hideFromIndex(),
            Fields\BelongsTo::make('City')->hideFromIndex(),
            Fields\Text::make('Title')->onlyOnIndex(),
            Fields\Text::make('', fn () => view('nova.gig-status', ['gig' => $this])->render())->onlyOnIndex()->textAlign('center')->asHtml(),
            Fields\Text::make('Title RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Title EN')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Date')->displayUsing(fn () => $this->fullDate())->exceptOnForms()->asHtml(),
            Fields\Date::make('Date')->onlyOnForms(),
            Fields\Text::make('Slug')->displayUsing(fn () => '<a class="no-underline dim text-primary" href="/life/' . $this->slug . '">' . $this->slug . '</a>')->rules('max:255')->asHtml(),
            Fields\Select::make('Status')->options([
                \App\Gig::STATUS_HIDDEN => 'Hidden',
                \App\Gig::STATUS_PUBLISHED => 'Published',
            ])->displayUsingLabels()->hideFromIndex(),
            Fields\Text::make('Meta Image')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Description RU')->rules('max:255')->hideFromIndex(),
            Fields\Text::make('Meta Description EN')->rules('max:255')->hideFromIndex(),
            Fields\Number::make('Views')->sortable()->displayUsing(fn () => $this->views ?: '')->exceptOnForms(),
            Fields\DateTime::make('Created At')->onlyOnDetail(),
            Fields\DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }
}
