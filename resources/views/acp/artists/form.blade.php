@include('tpl.form_errors')

{{ Form::text('title')->required() }}
{{ Form::text('slug')->required() }}

{{ ViewHelper::inputHiddenConcurrencyControl($model->updated_at) }}
