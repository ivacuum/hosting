@include('tpl.form_errors')

{{ Form::text('title_ru')->required() }}
{{ Form::text('title_en')->required() }}
{{ Form::text('slug')->required() }}
{{ Form::text('emoji') }}

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
