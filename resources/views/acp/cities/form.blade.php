@include('tpl.form_errors')

{!! Form::text('title_ru')->required()->html() !!}
{!! Form::text('title_en')->required()->html() !!}
{!! Form::text('slug')->required()->html() !!}
{!! Form::select('country_id')->required()->values(App\Country::forInputSelect())->html() !!}
{!! Form::text('iata')->html() !!}
{!! Form::text('lat')->html() !!}
{!! Form::text('lon')->html() !!}
