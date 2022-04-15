@include('tpl.form_errors')

{{ Form::select('country_id')->required()->values(resolve(App\Action\ListCountriesForInputSelectAction::class)->execute())->html() }}

{{ Form::text('title_ru')->required()->html() }}
{{ Form::text('title_en')->required()->html() }}
{{ Form::text('slug')->required()->html() }}
{{ Form::text('iata')->html() }}
{{ Form::text('lat')->html() }}
{{ Form::text('lon')->html() }}

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
