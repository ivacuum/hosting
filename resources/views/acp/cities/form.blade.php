@include('tpl.form_errors')

{{ Form::select('country_id')->required()->values(resolve(App\Action\ListCountriesForInputSelectAction::class)->execute()) }}

{{ Form::text('title_ru')->required() }}
{{ Form::text('title_en')->required() }}
{{ Form::text('slug')->required() }}
{{ Form::text('iata') }}
{{ Form::text('lat') }}
{{ Form::text('lon') }}

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
